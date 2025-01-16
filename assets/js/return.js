function daysDifference() {
    //define two variables and fetch the input from HTML form
    var dateI1 = document.getElementById("dateInput1").value;
    var dateI2 = document.getElementById("dateInput2").value;

    //define two date object variables to store the date values
    var date1 = new Date(dateI1);
    var date2 = new Date(dateI2);

    //calculate time difference
    var time_difference = date2.getTime() - date1.getTime();

    //calculate days difference by dividing total milliseconds in a day
    var result = time_difference / (1000 * 60 * 60 * 24);
    console.log(result);

    document.getElementById("result").value = result;

    // return document.getElementById("result").innerHTML =
    //     result + " days between both dates. ";
    //     // console.log(result);
}



function checkResult() {
    var days = document.getElementById('result').value;

    if (days >= 20) {
        rs = '100/=';
            console.log('100/=');
            // document.getElementById("fine").innerHTML = "100/=";
            document.getElementById("fine").innerText = "Hello World";
        }

        else
            if (days >= 15) {
                rs = '75/=';
                console.log('75/=');
            }

            else
                if (days >= 10) {
                    rs = '50/=';
                    console.log('50/=');
                }

                else
                    if (days >= 0) {
                        rs = '25/=';
                        console.log('25/=');
                    }
                    else {
                        rs = '0/=';
                        console.log('0/=');
                    }
                    // document.getElementById("fine").innerHTML = rs;
                    
                    document.getElementById("fine").value = rs;
}