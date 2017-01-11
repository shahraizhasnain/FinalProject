/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *  Setting configuration settings
 */

//setting Base Urls
var baseUrl = {
    apiServer: 'http://localhost/Ideas2016/api1/',
    websiteServer: 'http://localhost/Ideas2016/idea'
// apiServer: 'http://badarexposolutions.com/apps/api/',
// websiteServer: 'http://badarexposolutions.com/apps/idea/'
};
//setting API Urls
var api = {
//    user: {
//        signup: 'Session/signup',
//        login: 'Session/login',
//        logout: 'Session/logout',
//        check: 'User/check',
//        cart: 'User/cart',
//        profile: {
//            get: 'User/profile',
//            update: 'User/update',
//            delete: 'User/deelte'
//        }
//    },
//    country: {
//        get: 'Country/getCountries',
//        add: '',
//        update: '',
//        delete: ''
//    },
//    state: {
//        get: 'Country/getStates',
//        add: '',
//        update: '',
//        delete: ''
//    },
//    city: {
//        getall:'Country/getAllCities',
//        get: 'Country/getCities',
//        add: '',
//        update: '',
//        delete: ''
//    },
//    location: {
//        get: 'Country/getLocation'
//    },
//    dashboard: {
//        get: 'Dashboard/'
//    },
//    welcome: {
//        get: 'Welcome/'
//    },
//    home: {
//        get: 'Home/'
//    },
//    uploadFiles: {
//        profile: 'Upload_Files/image'
//    },
//    email: {
//        send: 'Send_Email/send'
//    },
    admin: {
        login: 'Admin/login',
        getallusers: 'Session/getallusers',
        pushnotification: 'Session/notification',
        viewNotification: 'Session/viewNotification',
        addevent: 'Session/events',
        addadmin: 'Admin/addAdmin',
//        getalladmin: 'Admin/viewAdmin',
        viewevents: 'Session/viewEvent',
        deleteEvent: 'Session/deleteEvent',
        getEventById: 'Session/getEventById',
        editEvent: 'Session/editEvent',
        addPrivilege: 'Admin/addPrivilege',
        getalladmin: 'Admin/viewAllAdmin',
        regUsers: 'Admin/regUsers'
    }
//
};
//setting Website Urls
var page = {
//    home: {
//        get: 'Home/'
//    },
//    dashboard: {
//        get: 'Dashboard/'
//    },
//    welcome: {
//        get: 'Welcome/'
//    },
//    user: {
//        add: 'null',
//        update: 'null',
//        delete: 'null',
//        profile: 'User/profile',
//        signup: 'User/signup',
//        login: 'User/login'
//    },
//    terms: {
//        termsCondition: 'Terms/',
//        termsMembers: 'Terms/membersTerms/'
//    },
//    faqs: {
//        faq: 'Faqs/'
//    },
//    privacy: {
//        policy: 'Privacy/'
//    },
//    prices: {
//        Prices: 'Prices/'
//    },
//    checkout: {
//        Checkout: 'Checkout/'
//    },
    admin: {
        dashboard: '/Admin/dashboard',
        assessmentForm: '/Admin/assessmentForm/',
        notification: '/Admin/notification',
        addevent: '/Admin/addevent',
        addAdmin: '/Admin/settings'
    }
};