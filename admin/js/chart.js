let selectCharOne = document.getElementById("selectYear-1")
let selectCharThree = document.getElementById("selectYear-3")
let checkFail = document.getElementById("check-fail");


let listCurrentYear = [2023,2023,2022]

const getCurrentYear = (element) => {
    let selectedIndex = element.selectedIndex;
    return element.options[selectedIndex].textContent;
}

const loadData = () => {
    let yearOne = getCurrentYear(selectCharOne)
    let yearThree = getCurrentYear(selectCharThree)

   let newListCurrentYear = []
   newListCurrentYear.push(parseInt(yearOne), parseInt(yearThree), parseInt(yearThree) -1)
   listCurrentYear = [...newListCurrentYear]
}

const handleUpdateCurrent = () => {
    loadData()
    console.log(listCurrentYear);

    // Lưu đánh giá vào cơ sở dữ liệu
    $.ajax({
        url: "./chart.php",
        method: "POST",
        data: {
            year1: listCurrentYear[0],
            year2: listCurrentYear[1],
            year3: listCurrentYear[2],
        },
        success: function(data){
            $("#wrapper").html(data);
        },
        error: function(xhr, status, error) {

            console.log("Error:", error);
        }
    });
}

const defaultDateValue = () => {
    const startDateDefault = new Date();
    startDateDefault.setMonth(startDateDefault.getMonth() - 1);
    const startDateDefaultFormatted = startDateDefault.toISOString().slice(0, 10);

    const startDateInput = document.getElementById('start_date');
    startDateInput.value = startDateDefaultFormatted;

    const endDateDefault = new Date();
    const endDateDefaultFormatted = endDateDefault.toISOString().slice(0, 10);

    const endDateInput = document.getElementById('end_date');
    endDateInput.value = endDateDefaultFormatted;
}


function validateDateInputs(event) {
    event.preventDefault();
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');


    // convert date: dd-mm-yyyy
    console.log("start_date", startDateInput.value.split("-").reverse().join("-"));
    console.log("end_date", endDateInput.value.split("-").reverse().join("-"));
  
    const startDateValue = startDateInput.value;
    const endDateValue = endDateInput.value;
  
    const startDate = new Date(startDateValue);
    const endDate = new Date(endDateValue);
    const today = new Date();
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