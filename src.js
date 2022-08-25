var ajax = new XMLHttpRequest();

function text() {
ajax.onreadystatechange = function() {
    if (ajax.readyState === 4) {
        if (ajax.status === 200) {
            console.dir(ajax.responseText);
            document.getElementById("result_table").innerHTML = ajax.response;
        }
    }
}
var date_profit = document.getElementById("date_profit").value;
ajax.open("get", "profit.php?date_profit=" + date_profit);
ajax.send();
}

function XML() {
    var date_available = document.getElementById("date_available").value;
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                
                console.dir(ajax);
                
                let rows = ajax.responseXML.firstChild.children;
                let result = "<table border ='1'>" + "<tr><th>Cars available on " + date_available + "</th></tr>";
                 
                // console.dir(rows.length);
                for (var i = 0; i < rows.length; i++) {
                    result += "<tr>";
                    result += "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>";
                    result += "</tr>";
                }
                document.getElementById("result_table").innerHTML = result;
            }
        }
    }
    
    ajax.open("get", "available_cars.php?date_available=" + date_available);
    ajax.send();
}

function J_SON() {
    ajax.onreadystatechange = function() {
        let rows = JSON.parse(ajax.responseText);
        
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                console.dir(ajax);
                let result = "<table border ='1'>"+"<tr><th>name</th><th>release_date</th><th>race</th><th>price</th></tr>";

                for (var i = 0; i < rows.length; i++) {
                    result += "<tr>";
                    result += "<td>" + rows[i].Name + "</td>";
                    result += "<td>" + rows[i].Release_date + "</td>";
                    result += "<td>" + rows[i].Race + "</td>";
                    result += "<td>" + rows[i].Price + "</td>";
                    result += "</tr>";
                }
                document.getElementById("result_table").innerHTML = result;
            }
        }
    };
    var vendor = document.getElementById("vendor").value;
    ajax.open("get", "get_vendor.php?vendor=" + vendor);
    ajax.send();
}