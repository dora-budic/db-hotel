var app = new Vue({
  el: '#root',
  data: {
    rooms: [],
    selectedRoom: null,
    currentId: null
  },
  mounted() {
    axios.get('http://localhost/Database,%20MySQL/db-hotel/db.php')
      .then((response) => {
        this.rooms = response.data;
      });
  },
  methods: {
    getInfo: function (id) {
      this.currentId = id;
      axios.get(`http://localhost/Database,%20MySQL/db-hotel/db.php?id=${id}`)
        .then((response) => {
          this.selectedRoom = response.data[0];
        });
    }
  }
});
