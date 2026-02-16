/**
 * [span_7](start_span)Practical 2: Dynamic Search Functionality[span_7](end_span)
 * [span_8](start_span)This function filters product cards in real-time[span_8](end_span)
 */
function filterProducts() {
    [span_9](start_span)// 1. Get the user input from the search bar[span_9](end_span)
    const input = document.getElementById('bakerySearch').value.toLowerCase();
    
    [span_10](start_span)// 2. Select all product cards[span_10](end_span)
    const cards = document.getElementsByClassName('product-card');

    [span_11](start_span)// 3. Loop through each card to check for matches[span_11](end_span)
    for (let i = 0; i < cards.length; i++) {
        const title = cards[i].getElementsByTagName('h3')[0].innerText.toLowerCase();
        
        [span_12](start_span)// 4. Update display: show if it matches search, hide if not[span_12](end_span)
        if (title.includes(input)) {
            cards[i].style.display = ""; // Show
        } else {
            cards[i].style.display = "none"; // Hide
        }
    }
}

