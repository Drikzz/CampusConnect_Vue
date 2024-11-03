document.addEventListener("DOMContentLoaded", function () {
    // Select all elements with the class 'bookmarked' or 'unbookmark'
    const bookmarkIcons = document.querySelectorAll(".bookmarked, .unbookmark");

    bookmarkIcons.forEach((icon) => {
        icon.addEventListener("click", function () {
            // Toggle visibility of bookmark icons
            const isBookmarked = icon.classList.contains("bookmarked");
            const parentContainer = icon.closest(".relative");

            if (isBookmarked) {
                parentContainer.querySelector(".bookmarked").classList.add("hidden");
                parentContainer.querySelector(".unbookmark").classList.remove("hidden");
            } else {
                parentContainer.querySelector(".bookmarked").classList.remove("hidden");
                parentContainer.querySelector(".unbookmark").classList.add("hidden");
            }
        });
    });

    // Select both buttons and text elements for Any and All
    const anyButton = document.querySelectorAll("button")[0];
    const allButton = document.querySelectorAll("button")[1];
    const anyText = anyButton.nextElementSibling;
    const allText = allButton.nextElementSibling;

    let isAnySelected = false; // Track the selection state for Any
    let isAllSelected = false; // Track the selection state for All

    // Function to set text color on click
    function setActiveTextColor(button, textElement, isSelected) {
        if (isSelected) {
            // If currently selected, unselect it
            textElement.classList.remove("text-black");
            textElement.classList.add("text-gray-400");
            return false; // Return false to indicate it's unselected
        } else {
            // Reset both to gray
            anyText.classList.remove("text-black");
            anyText.classList.add("text-gray-400");
            allText.classList.remove("text-black");
            allText.classList.add("text-gray-400");

            // Apply black text color to the clicked button's associated text
            textElement.classList.remove("text-gray-400");
            textElement.classList.add("text-black");
            return true; // Return true to indicate it's selected
        }
    }

    // Event listeners for Any and All buttons
    anyButton.addEventListener("click", function () {
        isAnySelected = setActiveTextColor(anyButton, anyText, isAnySelected);
        if (isAnySelected) {
            isAllSelected = false; // Unselect All if Any is selected
        }
    });

    allButton.addEventListener("click", function () {
        isAllSelected = setActiveTextColor(allButton, allText, isAllSelected);
        if (isAllSelected) {
            isAnySelected = false; // Unselect Any if All is selected
        }
    });

});