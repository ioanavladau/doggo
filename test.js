// sStartDate = '2011-02-01'
// sEndDate = '2011-02-28'

// let sStartYear = sStartDate.slice(0, 4);
// let sStartMonth = sStartDate.slice(5, 7);
// let sStartDay = sStartDate.slice(8, 10);

// let sEndYear = sEndDate.slice(0, 4);
// let sEndMonth = sEndDate.slice(5, 7);
// let sEndDay = sEndDate.slice(8, 10);

// let sStartMonthInt = parseInt(sStartMonth) - 1;	
// let sEndMonthInt = parseInt(sEndMonth) - 1;	

// Date.prototype.addDays = function(days) {
//     let dat = new Date(this.valueOf())
//     dat.setDate(dat.getDate() + days);
//     return dat;
// }

// function getDates(startDate, stopDate) {
//    let dateArray = new Array();
//    while (startDate <= stopDate) {
//      dateArray.push(startDate)
//      startDate = startDate.addDays(1);
//    }
//    return dateArray;
//  }

// let monthNames = [
//     "01", "02", "03",
//     "04", "05", "06", "07",
//     "08", "09", "10",
//     "11", "12"
// ];

// let dayNames = [
//     "01", "02", "03",
//     "04", "05", "06", "07",
//     "08", "09", "10",
//     "11", "12", "13", "14", "15", 
//     "16", "17", "18", "19", "20", "21", 
//     "22", "23", "24", "25", "26", "27", 
//     "28", "29", "30", "31",
// ];

// let dateArray = getDates(new Date(sStartYear, sStartMonthInt, sStartDay), new Date(sEndYear, sEndMonthInt, sEndDay));
// for (i = 0; i < dateArray.length; i ++ ) {
//     let monthIndex = dateArray[i].getMonth()
//     let dayIndex = dateArray[i].getDate()

//  console.log(dateArray[i].getFullYear()+"-"+monthNames[monthIndex]+"-"+dayNames[dayIndex]);
// }


// // console.log(new Date(1394104654000))


sTimestampSearchDate = (new Date('2019-05-10')).getTime()

console.log(sTimestampSearchDate)


// console.log(<?= $strToTimeResult ?>)