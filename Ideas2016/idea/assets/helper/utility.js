/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// ********  All Helper Functions ************ //

/**
 * Returns response messages
 * @param {string} statusCode
 * @param {string} msg
 * @param {object} data
 * @returns {object} jsonResp
 */
function responseMessage(statusCode, msg, data) {
    var jsonResp = {
//        status: statusCode,
//        message: msg,
//        data: data

        ajaxStatus: statusCode,
        ajaxMessage: msg,
        ajaxData: data
    };
    return jsonResp;
}

function setBrowserCookie(cname, cvalue, exdays, domainpath) {
    if (getBrowserCookie(cname)) {
        document.cookie = cname + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    } else {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; path=/";
    }

    console.log(document.cookie);
}

function getBrowserCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1);
        if (c.indexOf(name) == 0)
            return c.substring(name.length, c.length);
    }
//    return "";
}

function checkBrowserCookie() {
    var user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
            setCookie("username", user, 365);
        }
    }
}

function deleteBrowserCookie(cname) {
    document.cookie = cname + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;"
    if (getBrowserCookie(cname)) {
        console.log('Still Exist', cname);
    } else {
        console.log('This cookie is deleted', cname);
    }
}

/**
 * repeat
 * Reuseable function that will make ajax request 
 * @param (object) reqData
 * @param (function) callback
 * @return (object)  
 */
function callAjax(reqData, callback) {
    $.ajax({
        url: reqData.url,
        type: reqData.type,
        headers: reqData.headers,
//        contentType: 'multipart/form-data',
        data: reqData.data,
        success: function (responseData) {
            return callback(responseMessage(responseData.meta.status, "success", responseData));
        },
        error: function (err) {
            return callback(responseMessage("405", "error", err));
        }
    });

}

function callAjaxOnFileData(reqData, callback) {
    $.ajax({
        url: reqData.url,
        type: reqData.type,
        headers: reqData.headers,
        cache: false,
        contentType: false,
        processData: false,
        data: reqData.data,
        success: function (responseData) {
            return callback(responseMessage(responseData.meta.status, "success", responseData));
        },
        error: function (err) {
            return callback(responseMessage("405", "error", err));
        }
    });

}
