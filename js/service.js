var api = {
    category: {
        list: function () {
            return rest.get("category");
        },
        post: function (data) {
            return rest.post("category", data);
        },
        put: function (data, id) {
            return rest.put("category/" + id, data);
        },
        delete: function (id) {
            return rest.post("category/" + id);
        }
    },
    token: {
        post: function (data) {
            return rest.post("token", data);
        },
        expire: function (id) {
            return rest.delete("token/" + id);
        }
    },
    blog: {
        post: function (data) {
            return rest.post("post", data);
        },
        get: function () {
            return rest.get("post");
        },
        put: function (data, id) {
            return rest.post("post/" + id, data);
        },
        delete: function (id) {
            return rest.delete("post/" + id);
        },
        post: function (id) {
            return rest.post("post/" + id + "/publish", data);
        },
    }
};