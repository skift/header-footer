$(function() {
	'use strict';

    if (wkInfo && wkInfo.userTok) {
        var url = 'https://wallkit.skift.com/api/v1/user/history';
        var data = wkInfo.page;
        var headers = {
            token: wkInfo.userTok,
            resource: wkInfo.resourceTok
        };

        $.ajax({
            url: url,
            method: 'POST',
            headers: headers,
            data: JSON.stringify(data),
            dataType: 'json'
        });
    }
});