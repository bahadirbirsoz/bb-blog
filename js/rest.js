var rest = {
    baseUrl: "http://odv.lcl/api/",
    get: function (url) {
        return this.xhr(url, 'GET', {});
    }
    , post: function (url, data) {
        return this.xhr(url, 'POST', data);
    }
    , put: function (url, data) {
        return this.xhr(url, 'PUT', data);
    }
    , delete: function (url) {
        return this.xhr(url, 'DELETE', {});
    }
    , xhr: function (url, method, data) {
        ipfx.loading.show();
        return new Promise(function (resolve, reject) {
            if (!window.navigator.onLine) {
                return reject();
            }
            try {
                var xhr;
                xhr = new XMLHttpRequest();
                //url = "http://ipfx.lcl" + url;
                //rest.getBaseUrl().then(function (baseUrl) {


                //baseUrl = "http://ipfx.lcl";
                url = "http://odv.lcl/api/" + url;
                //url = "http://192.168.43.172" + url;
                //url = "http://192.168.79.40" + url;
                xhr.open(method, url, true);
                console.log(localStorage.getItem("token"));

                if (localStorage.hasOwnProperty("token")) {
                    xhr.setRequestHeader('TOKEN', localStorage.getItem("token"));
                }

                //xhr.setRequestHeader("Content-type", "application/json");
                xhr.send(JSON.stringify(data));
                xhr.addEventListener("readystatechange", function (e) {
                    if (xhr.readyState === 4) {
                        ipfx.loading.hide();
                        var response = JSON.parse(xhr.responseText);
                        if (xhr.status === 200) {
                            if (response.status === "success") {
                                return resolve(response.data);
                            } else {
                                return reject(response);
                            }
                        } else {
                            switch (xhr.status) {
                                case 401:
                                    ipfx.logout();
                                    break;
                            }

                            return reject(response);
                        }
                    }
                }, false);
                //});
            } catch (err) {
                return reject(err);
            }
        });
    }
};