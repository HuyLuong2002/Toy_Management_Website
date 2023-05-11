selectChart1 = document.getElementById("selectYear-1");
selectChart2 = document.getElementById("selectYear-2");
selectChart3 = document.getElementById("selectYear-3");

listCurrentYear = [2023,2023,2022];

getCurrentYear = (element) => {
    selectedIndex = element.selectedIndex;
    return element.options[selectedIndex].textContent;
}

loadData = () => {
    yearOne = getCurrentYear(selectChart1)
    yearThree = getCurrentYear(selectChart3)

    newListCurrentYear = []
   newListCurrentYear.push(parseInt(yearOne), parseInt(yearThree), parseInt(yearThree) -1)
   listCurrentYear = [...newListCurrentYear]
}

handleUpdateCurrent = () => {
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
            $("#content").html(data);
        },
        error: function(xhr, status, error) {

            console.log("Error:", error);
        }
    });
}

loadChart = () => {
    return ``
}