const uError = document.getElementById('uError');
const yearError = document.getElementById('yearError');
const bookInput = document.getElementById('book');
const yearInput = document.getElementById('year');
const table = document.getElementById('booklist');

function checkBookTitle() {
    let bookTitle = bookInput.value;

    if (bookTitle === "") {
        uError.innerHTML = "Please enter book title properly";
        uError.style.color = 'red';
        return false;
    }

    if (bookTitle.charCodeAt(0) === 32) {
        uError.innerHTML = "Name can't start with space";
        uError.style.color = 'red';
        return false;
    }

    for (let i = 0; i < bookTitle.length; i++) {
        let code = bookTitle.charCodeAt(i);
        let isUpperCase = (code >= 65 && code <= 90);
        let isLowerCase = (code >= 97 && code <= 122);
        let isDot = (code === 46);
        let isDash = (code === 45);
        let isSpace = (code === 32);

        if (!(isUpperCase || isLowerCase || isDot || isDash || isSpace)) {
            uError.innerHTML = "Name can contain only letters, dot (.), or dash (-)!";
            uError.style.color = 'red';
            return false;
        }
    }

    uError.innerHTML = "";
    return true;
}

function checkPubYear() {
    let yearVal = yearInput.value;
    let currentYear = new Date().getFullYear(); 

    if (yearVal === "") {
        yearError.innerHTML = "Year field cannot be blank";
        yearError.style.color = 'red';
        return false;
    }

    let yearNum = Number(yearVal);

    if (isNaN(yearNum) || yearVal.length !== 4) {
        yearError.innerHTML = "Please enter a valid 4-digit year";
        yearError.style.color = 'red';
        return false;
    }

    if (yearNum < 1900 || yearNum > currentYear) {
        yearError.innerHTML = `Year must be between 1900 and ${currentYear}`;
        yearError.style.color = 'red';
        return false;
    }

    yearError.innerHTML = "";
    return true;
}

function bookVal() {
    let isTitleValid = checkBookTitle();
    let isYearValid = checkPubYear();

    if (isTitleValid && isYearValid) {
        
        let title = bookInput.value;
        let year = parseInt(yearInput.value);

        let newRow = table.insertRow(-1); 

        let cellTitle = newRow.insertCell(0);
        let cellYear = newRow.insertCell(1);

        cellTitle.innerHTML = title;
        cellYear.innerHTML = year;
        if (year < 2000) {
            newRow.style.backgroundColor = "lightgray";
        } else {
            newRow.style.backgroundColor = "lightgreen";
        }


        bookInput.value = "";
        yearInput.value = "";
        
        return true;
    } else {
        alert("Please fix the errors before adding.");
        return false;
    }
}