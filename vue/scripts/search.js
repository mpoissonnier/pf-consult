function focused(element) {
  if (element == 1) {
    document.getElementById('search_dom1').className = "search_dom focused_search";
  }
  if (element == 2) {
    document.getElementById('search_dom2').className = "search_dom focused_search";
  }
}

function unfocused(element) {
  if (element == 1) {
    document.getElementById('search_dom1').className = "search_dom";
  }
  if (element == 2) {
    document.getElementById('search_dom2').className = "search_dom";
  }
}
