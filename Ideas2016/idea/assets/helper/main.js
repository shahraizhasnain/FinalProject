/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// **********************  ALL REUSEABLE FUNCTIONS ******************* //


// ********  All Functions related to Amin ************ //


function getallUser(callback) {

    var requestUrl = baseUrl.apiServer.concat(api.admin.getallusers);
    var reqData = {
        url: requestUrl
    };
    var respData = {
        message: "",
        data: "null"
    };
//  calling callAjax function 
    callAjax(reqData, function (resp) {
        if (resp.ajaxMessage === "success") {
            if (resp.ajaxData.meta.message === "all users") {
                respData = {
                    message: "Total Users",
                    data: resp.ajaxData.data
                };
            } else {
                respData.message = "no users signed up";
            }
        } else {
            respData.message = "Error";
        }
        return callback(respData);
    });
}
function regUsers(callback) {

    var requestUrl = baseUrl.apiServer.concat(api.admin.regUsers);
    var reqData = {
        url: requestUrl
    };
    var respData = {
        message: "",
        data: "null"
    };
//  calling callAjax function 
    callAjax(reqData, function (resp) {
        if (resp.ajaxMessage === "success") {
            if (resp.ajaxData.meta.message === "registered users") {
                respData = {
                    message: "registered users",
                    data: resp.ajaxData.data
                };
            } else {
                respData.message = "no registered users";
            }
        } else {
            respData.message = "Error";
        }
        return callback(respData);
    });
}
function getAllAdmin(callback) {

    var requestUrl = baseUrl.apiServer.concat(api.admin.getalladmin);
    var reqData = {
        url: requestUrl
    };
    var respData = {
        message: "",
        data: "null"
    };
//  calling callAjax function 
    callAjax(reqData, function (resp) {
        if (resp.ajaxMessage === "success") {
            if (resp.ajaxData.meta.message === "all admins") {
                respData = {
                    message: "Total Admins",
                    data: resp.ajaxData.data
                };
            } else {
                respData.message = "no admins";
            }
        } else {
            respData.message = "Error";
        }
        return callback(respData);
    });
}
function viewEvent(callback) {

    var requestUrl = baseUrl.apiServer.concat(api.admin.viewevents);
    var reqData = {
        url: requestUrl
    };
    var respData = {
        message: "",
        data: "null"
    };
//  calling callAjax function 
    callAjax(reqData, function (resp) {
        if (resp.ajaxMessage === "success") {
            if (resp.ajaxData.meta.message === "all events") {
                respData = {
                    message: "all events",
                    data: resp.ajaxData.data
                };
            } else {
                respData.message = "no events";
            }
        } else {
            respData.message = "Error";
        }
        return callback(respData);
    });
}
function deleteEvent(formData, callback) {

    var requestUrl = baseUrl.apiServer.concat(api.admin.deleteEvent);
    var reqData = {
        url: requestUrl,
        type: formData.type,
        headers: null,
        data: formData.data
    };
    var respData = {
        message: "",
        data: "null"
    };
//  calling callAjax function 
    callAjax(reqData, function (resp) {
        if (resp.ajaxMessage === "success") {
            if (resp.ajaxData.meta.message === "event deleted") {
                respData = {
                    message: "event deleted",
                    data: resp.ajaxData.data
                };
            } else {
                respData.message = "event not deleted";
            }
        } else {
            respData.message = "Error";
        }
        return callback(respData);
    });
}
function getEventById(formData, callback) {

    var requestUrl = baseUrl.apiServer.concat(api.admin.getEventById);
    var reqData = {
        url: requestUrl,
        type: formData.type,
        headers: null,
        data: formData.data
    };
    var respData = {
        message: "",
        data: "null"
    };
//  calling callAjax function 
    callAjax(reqData, function (resp) {
        if (resp.ajaxMessage === "success") {
            
            if (resp.ajaxData.meta.message === "event by id") {
                respData = {
                    message: "event by id",
                    data: resp.ajaxData.data
                };
            } else {
                respData.message = "no event on this id";
            }
        } else {
            respData.message = "Error";
        }
        return callback(respData);
    });
}

function viewNotification(callback) {

    var requestUrl = baseUrl.apiServer.concat(api.admin.viewNotification);
    var reqData = {
        url: requestUrl
    };
    var respData = {
        message: "",
        data: "null"
    };
//  calling callAjax function 
    callAjax(reqData, function (resp) {
        if (resp.ajaxMessage === "success") {
            if (resp.ajaxData.meta.message === "all notifications") {
                respData = {
                    message: "all notifications",
                    data: resp.ajaxData.data
                };
            } else {
                respData.message = "no notification";
            }
        } else {
            respData.message = "Error";
        }
        return callback(respData);
    });
}

function pushNotification(formData, callback) {
    var requestUrl = baseUrl.apiServer.concat(api.admin.pushnotification);
    var reqData = {
        url: requestUrl,
        type: formData.type,
        headers: null,
        data: formData.data
    };
    var respData = {
        message: "",
        data: "null"
    };
// calling AJAX 
    callAjax(reqData, function (resp) {
        if (resp.ajaxMessage === "success") {
            if (resp.ajaxData.meta.message === "Notification send successfuly") {
                respData = {
                    message: "Notification send successfuly",
                    data: resp.ajaxData.data
                };
            } else {
                respData.message = "not notified";
            }
        } else {
            respData.message = "Error";
        }
        return callback(respData);
    });

}
function addEvents(formData, callback) {
    var requestUrl = baseUrl.apiServer.concat(api.admin.addevent);
    var reqData = {
        url: requestUrl,
        type: formData.type,
        headers: null,
        data: formData.data
    };
    var respData = {
        message: "",
        data: "null"
    };
// calling AJAX 
    callAjax(reqData, function (resp) {
        if (resp.ajaxMessage === "success") {
            if (resp.ajaxData.meta.message === "event added") {
                respData = {
                    message: "event added",
                    data: resp.ajaxData.data
                };
            } else {
                respData.message = "event not added";
            }
        } else {
            respData.message = "Error";
        }
        return callback(respData);
    });

}
function editEvent(formData, callback) {
    var requestUrl = baseUrl.apiServer.concat(api.admin.editEvent);
    var reqData = {
        url: requestUrl,
        type: formData.type,
        headers: null,
        data: formData.data
    };
    var respData = {
        message: "",
        data: "null"
    };
// calling AJAX 
    callAjax(reqData, function (resp) {
        if (resp.ajaxMessage === "success") {
            if (resp.ajaxData.meta.message === "event updated") {
                respData = {
                    message: "event updated",
                    data: resp.ajaxData.data
                };
            } else {
                respData.message = "event not updated";
            }
        } else {
            respData.message = "Error";
        }
        return callback(respData);
    });

}
function addSubAdmin(formData, callback) {
    var requestUrl = baseUrl.apiServer.concat(api.admin.addadmin);
    var reqData = {
        url: requestUrl,
        type: formData.type,
        headers: null,
        data: formData.data
    };
    var respData = {
        message: "",
        data: "null"
    };
// calling AJAX 
    callAjax(reqData, function (resp) {
        if (resp.ajaxMessage === "success") {
            if (resp.ajaxData.meta.message === "admin added") {
                respData = {
                    message: "admin added",
                    data: resp.ajaxData.data
                };
            } else {
                respData.message = "admin already exist";
            }
        } else {
            respData.message = "Error";
        }
        return callback(respData);
    });

}
function addPrivilege(formData, callback) {
    var requestUrl = baseUrl.apiServer.concat(api.admin.addPrivilege);
    var reqData = {
        url: requestUrl,
        type: formData.type,
        headers: null,
        data: formData.data
    };
    console.log(reqData);
    var respData = {
        message: "",
        data: "null"
    };
// calling AJAX 
    callAjax(reqData, function (resp) {
        console.log(resp.ajaxData.meta.message);
        if (resp.ajaxMessage === "success") {
            console.log(resp.ajaxData.meta.message);
            if (resp.ajaxData.meta.message === "privilege added") {
                respData = {
                    message: "privilege added",
                    data: resp.ajaxData.data
                };
            } else {
                respData.message = "privilege not added";
            }
        } else {
            respData.message = "Error";
        }
        return callback(respData);
    });

}


/**
 * 
 * @param {object} formData
 * @returns {string}
 */

function loginUser(formData, callback) {
    var requestUrl = baseUrl.apiServer.concat(api.admin.login);
    var reqData = {
        url: requestUrl,
        type: formData.type,
        headers: null,
        data: formData.data
    };

    var respData = {
        message: "",
        data: "null"
    };
//  calling callAjax function 
    callAjax(reqData, function (resp) {
        if (resp.ajaxMessage === "success") {
            if (resp.ajaxData.meta.message === "user login successfully") {
                respData = {
                    message: resp.ajaxData.meta.message,
                    data: resp.ajaxData.data
                };
            } else if (resp.ajaxData.meta.message === "invalid username and password" || resp.ajaxData.meta.message === "username and password is required" || resp.ajaxData.meta.message === "user login failed") {
                respData = {
                    message: resp.ajaxData.meta.message,
                    data: resp.ajaxData.data
                };
            }
        } else {
            respData.message = "errors";
        }
        return callback(respData);
    });
}
