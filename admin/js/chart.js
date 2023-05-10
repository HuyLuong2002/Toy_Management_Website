let selectChart1 = document.getElementById("selectYear-1")
let selectChart2 = document.getElementById("selectYear-2")
let selectChart3 = document.getElementById("selectYear-3")

let listCurrentYear = [ 
    {
        year1: 2023,
    },
    {
        year2: 2023,
    },
    {
        year3: 2023,
    }
]

const getCurrentYear = (element) => {
    let selectedIndex = element.selectedIndex;
    return element.options[selectedIndex].textContent;
}

const loadData = () => {
    let yearOne = getCurrentYear(selectChart1)
    let yearTwo = getCurrentYear(selectChart2)
    let yearThree = getCurrentYear(selectChart3)

    listCurrentYear[0].year1 = yearOne
    listCurrentYear[1].year2 = yearTwo
    listCurrentYear[2].year3 = yearThree

}

const handleUpdateCurrent = async () => {
    loadData()
    console.log(listCurrentYear);

    // Lưu đánh giá vào cơ sở dữ liệu
    await $.ajax({
        url: "./chart.php",
        method: "GET",
        data: {current_year: listCurrentYear},
        success: function(data){
           
        },
        error: function(xhr, status, error) {

            console.log("Error:", error);
        }
    });
}