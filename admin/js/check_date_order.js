function validateDateInputs(event) {
    event.preventDefault();
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    let checkFail = document.getElementById("check-fail");


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
defaultDateValue()