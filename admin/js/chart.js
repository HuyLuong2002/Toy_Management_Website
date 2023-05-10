let selectChart1 = document.getElementById("selectYear-1")
let selectChart2 = document.getElementById("selectYear-2")
let selectChart3 = document.getElementById("selectYear-3")

let listCurrentYear = [2023,2023,2022]

const getCurrentYear = (element) => {
    let selectedIndex = element.selectedIndex;
    return element.options[selectedIndex].textContent;
}

const loadData = () => {
    let yearOne = getCurrentYear(selectChart1)
    let yearThree = getCurrentYear(selectChart3)

   let newListCurrentYear = []
   newListCurrentYear.push(parseInt(yearOne), parseInt(yearThree), parseInt(yearThree) -1)
   listCurrentYear = [...newListCurrentYear]
}

const handleUpdateCurrent = async () => {
    loadData()
    console.log(listCurrentYear);

    // Lưu đánh giá vào cơ sở dữ liệu
    await $.ajax({
        url: "",
        method: "GET",
        data: {current_year: listCurrentYear},
        success: function(data){
           
        },
        error: function(xhr, status, error) {

            console.log("Error:", error);
        }
    });
}

const loadChart = () => {
    return ``
}