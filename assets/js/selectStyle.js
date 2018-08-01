var customSelects, index, index2, selElmnt, newDiv, newDiv2, newDiv3;
/*look for any elements with the class "custom-select-w3":*/
customSelects = document.getElementsByClassName("custom-select-w3");
for (index = 0; index < customSelects.length; index++) {
  selElmnt = customSelects[index].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  newDiv = document.createElement("DIV");
  newDiv.setAttribute("class", "select-selected");
  newDiv.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  customSelects[index].appendChild(newDiv);
  /*for each element, create a new DIV that will contain the option list:*/
  newDiv2 = document.createElement("DIV");
  newDiv2.setAttribute("class", "select-items select-hide");
  for (index2 = 1; index2 < selElmnt.length; index2++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    newDiv3 = document.createElement("DIV");
    newDiv3.innerHTML = selElmnt.options[index2].innerHTML;
    newDiv3.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    newDiv2.appendChild(newDiv3);
  }
  customSelects[index].appendChild(newDiv2);
  newDiv.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
  });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect); 