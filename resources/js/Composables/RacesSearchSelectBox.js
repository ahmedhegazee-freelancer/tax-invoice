import { ref, computed } from "vue";

export const eventId = ref(null);
export const racesSelectOptions = computed(() => {
    return {
        create: false,
        valueField: "id",
        labelField: "title",
        searchField: "title",
        preload: true,
        // fetch remote data
        load: function (query, callback) {
            var url = route("race-search", {
                q: query,
                event: eventId.value,
            });
            // "https://api.github.com/search/repositories?q=" +
            // encodeURIComponent(query);
            // console.log(query);
            fetch(url)
                .then((response) => response.json())
                .then((json) => {
                    callback(json.data);
                })
                .catch(() => {
                    callback();
                });
        },
    };
});
export const availableRacesSelectOptions = computed(() => {
    return {
        create: false,
        valueField: "id",
        labelField: "title",
        searchField: "title",
        preload: true,
        // fetch remote data
        load: function (query, callback) {
            var url = route("race-search", {
                q: query,
                event: eventId.value,
                status: 0,
            });
            // "https://api.github.com/search/repositories?q=" +
            // encodeURIComponent(query);
            // console.log(query);
            fetch(url)
                .then((response) => response.json())
                .then((json) => {
                    callback(json.data);
                })
                .catch(() => {
                    callback();
                });
        },
    };
});
