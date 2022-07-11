$(document).ready(function () {
  var rowFull = false;
  //unlocked = true, locked = false

  //stores day in a localstorage with the key of day
  var dayTemp = new Date(),
    day = dayTemp.getDate(),
    dayOld = localStorage.getItem("day");
  day = 35; /*dadadadadadaddadadadadadadadaddadadadddayyyyyayyayyayayya*/
  //checks day to see if row have to be reset
  if (dayOld == null) {
    //if day hasn't been stores store it and set form to row 1
    localStorage.setItem("row1", "unlocked");
    localStorage.setItem("row2", "locked");
    localStorage.setItem("row3", "locked");
    localStorage.setItem("row4", "locked");
    localStorage.setItem("day", day);
    for (x = 1; x < 29; x++) {
      localStorage.setItem("input" + x, "");
      var checktemp = localStorage.getItem("input" + x, "");
      console.log("letter reset: " + checktemp);
    }
  } else if (dayOld != day) {
    //if new day start on row 1
    localStorage.setItem("row1", "unlocked");
    localStorage.setItem("row2", "locked");
    localStorage.setItem("row3", "locked");
    localStorage.setItem("row4", "locked");
    localStorage.setItem("day", day);
    console.log("current day: " + day);
    console.log("previous day: " + dayOld);
    for (x = 1; x < 29; x++) {
      localStorage.setItem("input" + x, "");
      var checktemp = localStorage.getItem("input" + x, "");
      console.log("letter reset: " + checktemp);
    }
  } else if (dayOld == day) {
    console.log("current day: " + day);
    console.log("previous day: " + dayOld);
    for (x = 1; x < 29; x++) {
      var checktemp = localStorage.getItem("input" + x);
      $("#input" + x).val(checktemp);
    }
  }

  //stores row checks in variable to check in if statement
  console.log("on page load");
  var checkRowOne = localStorage.getItem("row1");
  console.log("Row One Status: " + checkRowOne);
  var checkRowTwo = localStorage.getItem("row2");
  console.log("Row Two Status: " + checkRowTwo);
  var checkRowThree = localStorage.getItem("row3");
  console.log("Row Three Status: " + checkRowThree);
  var checkRowFour = localStorage.getItem("row4");
  console.log("Row Four Status: " + checkRowFour);
  if (checkRowOne == "unlocked") {
    var start = 1;
  } else if (checkRowTwo == "unlocked") {
    var start = 8;
  } else if (checkRowThree == "unlocked") {
    var start = 15;
  } else if (checkRowFour == "unlocked") {
    var start = 22;
  }
  //if all are locked
  else {
    var start = -7;
  }

  // locks tows
  function lockRow(n) {
    //n is where the starting point for keyValues will be entered
    //y is where the locks start locking
    y = n + 7;
    q = n - 7;
    //checks if the previous rows should be locked or not
    if (n > 7) {
      //locks row one if row two is active
      for (x = 1; x < 8; x++) {
        //counts from 1 to 7 locking subsequent rows
        $("#input" + x).attr("disabled", "disabled");
      }
      for (x = n; x < y; x++) {
        var temp = "input" + x;
        document.getElementById(temp).disabled = false;
      }
    }
    if (n > 14) {
      for (x = 8; x < 15; x++) {
        //counts from 8 to 14 locking subsequent rows
        $("#input" + x).attr("disabled", "disabled");
      }
      for (x = n; x < y; x++) {
        var temp = "input" + x;
        document.getElementById(temp).disabled = false;
      }
    }
    if (n > 21) {
      for (x = 15; x < 22; x++) {
        //counts from 15 to 21 locking subsequent rows
        $("#input" + x).attr("disabled", "disabled");
      }
      for (x = n; x < y; x++) {
        var temp = "input" + x;
        document.getElementById(temp).disabled = false;
      }
    }
    for (x = y; x < 29; x++) {
      $("#input" + x).attr("disabled", "disabled");
    }
    return n;
  }
  var setLowest = lockRow(start),
    setMax = setLowest + 6,
    setAfterMax = setMax + 1,
    setCurrent = setLowest;
  // console.log("setCurrent: " + setCurrent);
  // console.log("setLowest: " + setLowest);
  // console.log("setBeforeMax: " + setAfterMax);
  // console.log("setMax: " + setMax);

  $(".key").click(function () {
    del = false;
    keyValue = $(this).attr("id");
    //check to keep user on the first input of a row after spamming delete

    if (setCurrent < setLowest) {
      setCurrent = setLowest;
    }
    //check to see if user click delete
    if (keyValue == "back") {
      del = true;
      setCurrent--;
      keyValue = "";
      rowFull = false;
      $("#input" + setCurrent).val(keyValue);

      console.log("setCurrent: " + setCurrent);
      //checks if the user triggered the rowFull variable and after deleting the last entry into the row the user can enter a different letter
      if (setCurrent < 8 && rowFull) {
        rowFull = false;
      }
    } else if (keyValue == "enter") {
      var minlength = 1,
        position = 1,
        attemptStore = "",
        attemptCounter = 0,
        filledOut = true,
        keyValue = "",
        letterT = $("#letterT").val(),
        letterO = $("#letterO").val(),
        letterC = $("#letterC").val(),
        letterK = $("#letterK").val(),
        letterI = $("#letterI").val(),
        letterE = $("#letterE").val(),
        //position check. This stores the checkInputs value without taking input from the database. So the Attempt box will store
        //the users guess and values assigned to that guess
        posOne = B,
        posTwo = B,
        posThree = B,
        posFour = B,
        posFive = B,
        posSix = B,
        posSeven = B;
      console.log("On sub letterT: " + letterT);
      console.log("On sub letterO: " + letterO);
      console.log("On sub letterC: " + letterC);
      console.log("On sub letterK: " + letterK);
      console.log("On sub letterI: " + letterI);
      console.log("On sub letterE: " + letterE);
      //ensures focus on next line after submit
      if (setCurrent == 8) {
        input8.focus();
      }
      if (setCurrent == 15) {
        input15.focus();
      }
      if (setCurrent == setMax) {
        setCurrent++;
      }
      $("#input" + setCurrent).val(keyValue);

      for (x = setLowest; x < setAfterMax; x++) {
        var checkInput = $("#input" + x).val();
        attemptCounter++;
        //store letters so they stay when page is refreshed
        localStorage.setItem("input" + x, checkInput);
        // console.log("letter: " + checkInput + " stored as input " + x);
        //store letters in a variable as to transfer to database
        var attemptStore = attemptStore + checkInput;
        // console.log("attempt string: " + attemptStore);
        if (checkInput.length < minlength) {
          //not filled out
          filledOut = false;
          alert("You did't fill out all the inputs...");
          console.log("filledOut: " + filledOut);
          break;
        } else {
          //toockie check
          //takes already filled out letter variable and will only rewrite it if new value is higher b < y < g
          function checkNum(letter) {
            if (letter == "G") {
              return letter;
            } else {
              letter = "Y";
              return letter;
            }
          }
          //checks to see if current position's input is a correct letter in the wrong spot
          function checkPos(posLetter, input) {
            letterArray = ["T", "O", "C", "K", "I", "E"];
            for (i = 0; i < letterArray.length; i++) {
              //removes correct letter leaving all y values
              if (letterArray[i] == posLetter) {
                letterArray.splice(i, 1);
              }
            }
            //checks if input is a correct letters in wrong position
            var hit = false;
            for (i = 0; i < letterArray.length; i++) {
              if (letterArray[i] == input) {
                hit = true;
              }
            }
            if (hit) {
              return "Y";
            } else {
              return "B";
            }
            // alert(letterArray);
          }
          if (checkInput == "T") {
            if (position == 1) {
              letterT = "G";
            } else {
              letterT = checkNum("letterT");
            }
          }
          if (checkInput == "O") {
            if (position == 2 || position == 3) {
              letterO = "G";
            } else {
              letterO = checkNum("letterO");
            }
          }
          if (checkInput == "C") {
            if (position == 4) {
              letterC = "G";
            } else {
              letterC = checkNum("letterC");
            }
          }
          if (checkInput == "K") {
            if (position == 5) {
              letterK = "G";
            } else {
              letterK = checkNum("letterK");
            }
          }
          if (checkInput == "I") {
            if (position == 6) {
              letterI = "G";
            } else {
              letterI = checkNum("letterI");
            }
          }
          if (checkInput == "E") {
            if (position == 7) {
              letterE = "G";
            } else {
              letterE = checkNum("letterE");
            }
          }
          if (position == 1) {
            $("#letterOne").val(checkInput);
            if (checkInput == "T") {
              $("#posOne").val("G");
            } else {
              posOne = checkPos("T", checkInput);
              $("#posOne").val(posOne);
            }
            // alert(posOne);
          }
          if (position == 2) {
            $("#letterTwo").val(checkInput);
            if (checkInput == "O") {
              $("#posTwo").val("G");
            } else {
              posTwo = checkPos("O", checkInput);
              $("#posTwo").val(posTwo);
            }
            // alert(posTwo);
          }
          if (position == 3) {
            $("#letterThree").val(checkInput);
            if (checkInput == "O") {
              $("#posThree").val("G");
            } else {
              posThree = checkPos("O", checkInput);
              $("#posThree").val(posThree);
            }
            // alert(posThree);
          }
          if (position == 4) {
            $("#letterFour").val(checkInput);
            if (checkInput == "C") {
              $("#posFour").val("G");
            } else {
              posFour = checkPos("C", checkInput);
              $("#posFour").val(posFour);
            }
            // alert(posFour);
          }
          if (position == 5) {
            $("#letterFive").val(checkInput);
            if (checkInput == "K") {
              $("#posFive").val("G");
            } else {
              posFive = checkPos("K", checkInput);
              $("#posFive").val(posFive);
            }
            // alert(posFive);
          }
          if (position == 6) {
            $("#letterSix").val(checkInput);
            if (checkInput == "I") {
              $("#posSix").val("G");
            } else {
              posSix = checkPos("I", checkInput);
              $("#posSix").val(posSix);
            }
            // alert(posSix);
          }
          if (position == 7) {
            $("#letterSeven").val(checkInput);
            if (checkInput == "E") {
              $("#posSeven").val("G");
            } else {
              posSeven = checkPos("E", checkInput);
              $("#posSeven").val(posSeven);
            }
            // alert(posSeven);
          }
          //change color of input where x is alerting
          position++;
          console.log(filledOut + " num " + x);
        }
      }
      console.log(attemptStore);
      $("#store").val(attemptStore);
      $("#letterT").val(letterT);
      $("#letterO").val(letterO);
      $("#letterC").val(letterC);
      $("#letterK").val(letterK);
      $("#letterI").val(letterI);
      $("#letterE").val(letterE);
      $("#btnThree").click();
    }
    //for each loop ends send attemptStore to php to be transferer to database
    if (filledOut) {
      if (checkRowOne == "unlocked") {
        localStorage.setItem("row1", "locked");
        localStorage.setItem("row2", "unlocked");
        var start = 8;
        //sets focus to new row start
        (setLowest = lockRow(start)),
          (setMax = setLowest + 6),
          (setAfterMax = setMax + 1),
          (setCurrent = setLowest),
          (checkRowOne = localStorage.getItem("row1")),
          (checkRowTwo = localStorage.getItem("row2"));
        console.log("Row One Status: " + checkRowOne);
        console.log("Row Two Status: " + checkRowTwo);
      } else if (checkRowTwo == "unlocked") {
        localStorage.setItem("row2", "locked");
        localStorage.setItem("row3", "unlocked");
        var start = 15;
        (setLowest = lockRow(start)),
          (setMax = setLowest + 6),
          (setAfterMax = setMax + 1),
          (setCurrent = setLowest),
          (checkRowTwo = localStorage.getItem("row2")),
          (checkRowThree = localStorage.getItem("row3"));
        console.log("Row Two Status: " + checkRowOne);
        console.log("Row Three Status: " + checkRowThree);
      } else if (checkRowThree == "unlocked") {
        localStorage.setItem("row3", "locked");
        localStorage.setItem("row4", "unlocked");
        var start = 22;
        (setLowest = lockRow(start)),
          (setMax = setLowest + 6),
          (setAfterMax = setMax + 1),
          (setCurrent = setLowest),
          (checkRowThree = localStorage.getItem("row3")),
          (checkRowFour = localStorage.getItem("row4"));
        console.log("Row Three Status: " + checkRowThree);
        console.log("Row Four Status: " + checkRowFour);
      } else if (checkRowFour == "unlocked") {
        if (attemptCounter == 7) {
          alert("YOU HAVE RUN OF OF ATTEMPTS! TRY AGAIN TOMORROW");
          for (x = 1; x < 29; x++) {
            $("#input" + x).attr("disabled", "disabled");
          }
          localStorage.setItem("row4", "locked");
        }
      }
    } else {
      if (setCurrent > setMax) {
        setCurrent = setAfterMax;
        rowFull = true;
        console.log("Row One: " + rowFull);
        console.log("setCurrent: " + setCurrent);
      }
      //checks to see if row is already full
      if (!rowFull && !del) {
        $("#input" + setCurrent).val(keyValue);
        setCurrent++;
        console.log("setCurrent: " + setCurrent);
        console.log("Row One Full: " + rowFull);
      }
    }
  });

  var input1 = document.getElementById("input1"),
    input2 = document.getElementById("input2"),
    input3 = document.getElementById("input3"),
    input4 = document.getElementById("input4"),
    input5 = document.getElementById("input5"),
    input6 = document.getElementById("input6"),
    input7 = document.getElementById("input7");

  input1.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input2.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input1.focus();
    }
  };
  input2.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input3.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input1.focus();
    }
  };
  input3.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input4.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input2.focus();
    }
  };
  input4.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input5.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input3.focus();
    }
  };
  input5.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input6.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input4.focus();
    }
  };
  input6.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input7.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input5.focus();
    }
  };
  input7.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input7.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input6.focus();
    }
  };

  var input8 = document.getElementById("input8"),
    input9 = document.getElementById("input9"),
    input10 = document.getElementById("input10"),
    input11 = document.getElementById("input11"),
    input12 = document.getElementById("input12"),
    input13 = document.getElementById("input13"),
    input14 = document.getElementById("input14");

  input8.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input9.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input8.focus();
    }
  };
  input9.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input10.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input8.focus();
    }
  };
  input10.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input11.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input9.focus();
    }
  };
  input11.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input12.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input10.focus();
    }
  };
  input12.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input13.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input11.focus();
    }
  };
  input13.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input14.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input12.focus();
    }
  };
  input14.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input14.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input13.focus();
    }
  };

  var input15 = document.getElementById("input15"),
    input16 = document.getElementById("input16"),
    input17 = document.getElementById("input17"),
    input18 = document.getElementById("input18"),
    input19 = document.getElementById("input19"),
    input20 = document.getElementById("input20"),
    input21 = document.getElementById("input21");

  input15.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input16.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input15.focus();
    }
  };
  input16.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input17.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input15.focus();
    }
  };
  input17.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input18.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input16.focus();
    }
  };
  input18.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input19.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input17.focus();
    }
  };
  input19.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input20.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input18.focus();
    }
  };
  input20.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input21.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input19.focus();
    }
  };
  input21.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input21.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input20.focus();
    }
  };

  var input22 = document.getElementById("input22"),
    input23 = document.getElementById("input23"),
    input24 = document.getElementById("input24"),
    input25 = document.getElementById("input25"),
    input26 = document.getElementById("input26"),
    input27 = document.getElementById("input27"),
    input28 = document.getElementById("input28");

  input22.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input23.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input22.focus();
    }
  };
  input23.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input24.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input22.focus();
    }
  };
  input24.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input25.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input23.focus();
    }
  };
  input25.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input26.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input24.focus();
    }
  };
  input26.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input27.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input25.focus();
    }
  };
  input27.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input28.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input26.focus();
    }
  };
  input28.onkeyup = function () {
    if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
      input28.focus();
    } else if (
      this.value.length === parseInt(this.attributes["minlength"].value)
    ) {
      input27.focus();
    }
  };
});
