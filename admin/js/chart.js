selectChartOne = document.getElementById("selectYear-1")
selectChartThree = document.getElementById("selectYear-3")
checkFail = document.getElementById("check-fail");


listCurrentYear = [2023,2023,2022];

getCurrentYear = (element) => {
    selectedIndex = element.selectedIndex;
    return element.options[selectedIndex].textContent;
}

loadData = () => {
    yearOne = getCurrentYear(selectChartOne)
    yearThree = getCurrentYear(selectChartThree)

    newListCurrentYear = []
    newListCurrentYear.push(parseInt(yearOne), parseInt(yearThree), parseInt(yearThree) -1)
    listCurrentYear = [...newListCurrentYear]
}

updateCurrentDate = (listCurrentYear) => {
    selectChartOne.value = listCurrentYear[0];
    selectChartThree.value = listCurrentYear[1]
}

handleUpdateCurrent = async () => {
    loadData()
    localStorage.setItem('currentYear', JSON.stringify(listCurrentYear));

    // Lưu đánh giá vào cơ sở dữ liệu
    await $.ajax({
        url: "./chart.php",
        method: "POST",
        data: {
            year1: listCurrentYear[0],
            year2: listCurrentYear[1],
            year3: listCurrentYear[2],
        },
        success: function(data){
            $("#content").html(data);
            // updateCurrentDate(listCurrentYear)
        },
        error: function(xhr, status, error) {

            console.log("Error:", error);
        }
    });

    let currentYear = JSON.parse(localStorage.getItem('currentYear'));

    updateCurrentDate(currentYear)
}

defaultDateValue = () => {
    startDateDefault = new Date();
    startDateDefault.setMonth(startDateDefault.getMonth() - 1);
    startDateDefaultFormatted = startDateDefault.toISOString().slice(0, 10);

    startDateInput = document.getElementById('start_date');
    startDateInput.value = startDateDefaultFormatted;

    endDateDefault = new Date();
    endDateDefaultFormatted = endDateDefault.toISOString().slice(0, 10);

    endDateInput = document.getElementById('end_date');
    endDateInput.value = endDateDefaultFormatted;
}


function validateDateInputs(event) {
    event.preventDefault();
    startDateInput = document.getElementById('start_date');
    endDateInput = document.getElementById('end_date');


    // convert date: dd-mm-yyyy
    console.log("start_date", startDateInput.value.split("-").reverse().join("-"));
    console.log("end_date", endDateInput.value.split("-").reverse().join("-"));
  
    startDateValue = startDateInput.value;
    endDateValue = endDateInput.value;
  
    startDate = new Date(startDateValue);
    endDate = new Date(endDateValue);
    today = new Date();
    today.setHours(0, 0, 0, 0);
  
    if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
      checkFail.innerHTML = "<span>&times;</span> Vui lòng nhập đầy đủ ngày bắt đầu và ngày kết thúc"
      checkFail.style.display = "block"
      checkFail.classList.add("hide")

      setTimeout(function() {
          checkFail.style.display = 'none';
          checkFail.classList.remove('hide');
      }, 3000);
      defaultDateValue()

      return false;
    }
  
    if (startDate > endDate) {
      checkFail.innerHTML = "<span>&times;</span> Ngày bắt đầu không thể lớn hơn ngày kết thúc."
      checkFail.style.display = "block"
      checkFail.classList.add("hide")

      setTimeout(function() {
          checkFail.style.display = 'none';
          checkFail.classList.remove('hide');
      }, 3000);
      defaultDateValue()

      return false;
    }
  
    if (endDate.setHours(0, 0, 0, 0) > today.setHours(0, 0, 0, 0)) {

        checkFail.innerHTML = "<span>&times;</span> Ngày kết thúc không thể là ngày trong tương lai."
        checkFail.style.display = "block"
        checkFail.classList.add("hide")

        setTimeout(function() {
            checkFail.style.display = 'none';
            checkFail.classList.remove('hide');
        }, 3000);
        defaultDateValue()

        return false;
    }
  
    return true;
}

defaultDateValue()
updateCurrentDate(listCurrentYear)
