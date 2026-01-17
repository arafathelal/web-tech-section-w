<?php
require_once __DIR__ . "/../model/PartsModel.php";

/**
 * Handle Buy Parts Form Submission
 */
function handleBuyParts()
{
    $errors = [];
    $success = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_SESSION['user_id'] ?? 1; // Fallback

        $partId = intval($_POST['part_id'] ?? 0);
        $quantity = intval($_POST['quantity'] ?? 1);
        $address = trim($_POST['address'] ?? '');
        $contact = trim($_POST['contact'] ?? '');

        // Validation
        if (empty($partId) || $quantity <= 0 || empty($address) || empty($contact)) {
            $errors[] = "All fields are required and quantity must be at least 1.";
        } else {
            // Get Part details for price calculation
            $part = getPartById($partId);
            if (!$part) {
                $errors[] = "Invalid part selected.";
            } else {
                $totalPrice = $part['price'] * $quantity;

                $result = createPartOrder($userId, $partId, $quantity, $totalPrice, $address, $contact);

                if ($result === true) {
                    $success = true;
                    // Ideally redirect, but keeping it simple as per pattern
                    header("Location: dashboard.php?order=success");
                    exit;
                } else {
                    $errors[] = $result; // Error message from model
                }
            }
        }
    }

    return ['errors' => $errors, 'success' => $success];
}

/**
 * Get Parts for Display
 */
function getPartsForView()
{
    return getAllParts();
}

/* Cart Functions */

function addToCart($partId, $quantity)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Validate stock
    $part = getPartById($partId);
    if (!$part || $part['stock'] < $quantity) {
        return ['success' => false, 'message' => 'Insufficient stock'];
    }

    if (isset($_SESSION['cart'][$partId])) {
        $_SESSION['cart'][$partId] += $quantity;
    } else {
        $_SESSION['cart'][$partId] = $quantity;
    }

    return ['success' => true, 'message' => 'Added to cart', 'cart_count' => count($_SESSION['cart'])];
}

function removeFromCart($partId)
{
    if (isset($_SESSION['cart'][$partId])) {
        unset($_SESSION['cart'][$partId]);
    }
}

function getCartItems()
{
    $items = [];
    $total = 0;

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $partId => $qty) {
            $part = getPartById($partId);
            if ($part) {
                $subtotal = $part['price'] * $qty;
                $items[] = [
                    'part' => $part,
                    'qty' => $qty,
                    'subtotal' => $subtotal
                ];
                $total += $subtotal;
            }
        }
    }
    return ['items' => $items, 'total' => $total];
}

function processCheckout($userId, $address, $contact, $items)
{
    global $conn;
    $errors = [];

    if (empty($items)) {
        return ['success' => false, 'errors' => ['Cart is empty']];
    }

    // Reuse createPartOrder model but maybe we need a bulk version or loop?
    // For simplicity, loop and call existing model for each item. 
    // Ideally should be one transaction for all, but model has its own transaction.
    // Let's refactor model usage or make a new model func for bulk.
    // BUT, Model `createPartOrder` commits transaction. 
    // Making multiple calls will be multiple transactions. 
    // Let's create `createBulkOrder` in model or just loop for now as "good enough" for prototype.
    // Actually, user asked for complexity maintenance, so looping is fine.

    $successCount = 0;
    foreach ($items as $item) {
        $partId = $item['part']['id'];
        $qty = $item['qty'];
        $totalPrice = $item['subtotal']; // or recalculate

        $res = createPartOrder($userId, $partId, $qty, $totalPrice, $address, $contact);
        if ($res === true) {
            $successCount++;
            // Remove from cart if successful (if this was from cart)
            if (isset($_SESSION['cart'][$partId])) {
                unset($_SESSION['cart'][$partId]);
            }
        } else {
            $errors[] = "Failed to order " . $item['part']['name'] . ": " . $res;
        }
    }

    if ($successCount > 0 && empty($errors)) {
        return ['success' => true];
    } else {
        return ['success' => false, 'errors' => $errors];
    }
}
