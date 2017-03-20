Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=token]").attr("value");

new Vue({
    el: '#page-top',
    data: {
        address: {},
		toShow: false,
        createData: {
            content: null
        },
        updateData: {
            content: null
        },
        error: {
            createContent: null,
            updateContent: null,
			number: null		
        },
        temp: {
            id: null,
            index: null           
        },
        resource: null,
		sQuery: {
            query: null
        }
    },
    ready: function() {
        this.resource = this.$resource('address/:id');
        this.paginate();
    },
    methods: {
		search: function() {
			this.$http.get('search', this.sQuery, function (data) {
                setData(this, data);
            }).error(function (data) {
                console.log("Error:" + JSON.stringify(data));
            });
        },
        paginate: function() {
            this.resource.get(function (data) {
                setData(this, data);
            }).error(function (data) {
                console.log("Error:" + JSON.stringify(data));
           });
        },
        create: function() {
			this.error.createContent = null;
            this.createData.content = null;
			this.error.number = null;
			$('#addModal').modal();
        },
		send: function() {
			var num = this.createData.content.number;
			this.error.number = null;
			var reg = /^\+[0-9]{2} [0-9]{2} [0-9]{6}[0-9]*$/g;
			if (reg.test(num))
			{
				this.resource.save(this.createData, function (data) {
					this.createData.content = null;
					setData(this, data);
					window.location = '/';
					$('#addModal').modal('hide');
				}).error(function (data) {
					console.log("Error:" + JSON.stringify(data));
					this.error.createData = data.content[0];
                });
			}
			else
			{
				console.log("Error: RegExp");
				this.error.number = "Number should be like +39 02 1234567";
			}
        },
        destroy: function(id) {
            var self = this;
            swal({
              title: "Really delete this address ?",
              text: "You will not be able to recover this adrress !",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false              
            },
            function(){
                self.resource.delete({id: id}, function (data) {
                    swal("Deleted!", "The address has been deleted.", "success");
                    self.paginate();
                }).error(function (data) {
                    console.log("Error:" + JSON.stringify(data));
                });
            });
        },
        edit: function(id, index) {
            this.error.updateContent = null;
			this.error.number = null;
            this.temp.id = this.address[index].id;
            this.temp.index = index;
            this.updateData.content = this.address[index];
            $('#myModal').modal();           
        },
        update: function() {
            this.error.updateContent = null;
			this.error.number = null;
			var reg = /^\+[0-9]{2} [0-9]{2} [0-9]{6}[0-9]*$/g;
			var num = this.updateData.content.number;
			if (reg.test(num))
			{
				this.resource.update({id: this.temp.id}, this.updateData, function (data) {
					this.address[this.temp.index].content = this.updateData.content;
					$('#myModal').modal('hide');
				}).error(function (data) {
					console.log("Error:" + JSON.stringify(data));
					this.error.updateContent = data.content[0];
				}); 
			}
			else
			{
				console.log("Error: RegExp");
				this.error.number = "Number should be like +39 02 1234567";
			}
        }
    }
});

function setData (instance, data) {
	instance.address = data;
}
