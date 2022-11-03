/*=========================================================================================
    File Name: app-file-manager.js
    Description: app-file-manager js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  var chatUsersListWrapper = $('.chat-application .chat-user-list-wrapper'),
    fileContentBody = $('.file-manager-content-body');


  if (chatUsersListWrapper.length > 0) {
    var chatUserList = new PerfectScrollbar(chatUsersListWrapper[0]);
  }


});
