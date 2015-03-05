'use strict';

adsApp.factory('authenticationService', function() {
	var key = 'user';
	function saveUser(data) {
		localStorage.setItem(key, angular.toJson(data))
	}

	function getUser() {
		return angular.fromJson(localStorage.getItem(key));
	}

	function getHeaders(argument) {
		var headers = {};
		var userData = getUser();
		if (userData) {
			headers.Authorization = 'Bearer ' + getUser().access_token;
		};

		return headers;
	}

	function removeUser() {
		localStorage.removeItem(key);
		localStorage.clear();
	}

	function isLogged() {
		return !!getUser();
	}

	function isAdmin() {
		var isAdmin = getUser().isAdmin;
		return isAdmin;
	}

	return {
		saveUser: saveUser,
		getUser: getUser,
		getHeaders: getHeaders,
		removeUser: removeUser,
		isLogged: isLogged,
		isAdmin: isAdmin
	}
});