function logIn(button) {
    const adminName = button.parentNode.getElementsByTagName("input")[0].value;
    const adminPass = button.parentNode.getElementsByTagName("input")[1].value;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText != "" && this.responseText != null) {
                alert(this.responseText);
            }
            else {
                window.location.replace("../ordersList/ordersList.php");
            }
        }
    };
    request.open("GET", `login.php?Admin_Name=${adminName}&Admin_Pass=${adminPass}`, true);
    request.send();
}