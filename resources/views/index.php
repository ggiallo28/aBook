<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Address Book</title>

        <!-- Bootstrap Core CSS -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/grayscale.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="js/jquery.easing.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/grayscale.js"></script>

    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

        <!-- Navigation -->
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container">
				<div class="col-lg-10 col-lg-offset-1">
					<div class="row">
						<form class="navbar-form search" role="search">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Search" v-model="sQuery.query">
								<div class="input-group-btn">
									<button class="btn btn-default" @click="search()"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</form>
						<h2 class="add">
							<a @click="create()" href="#" title="Add contact">
								<span class="fa fa-plus-square"></span>
							</a>
						</h2>
						<div class="clearfix"></div>
					</div>
					<div class="navbar-header" style="margin-top: 8px">
						
					</div>
				</div>
            </div>
        </nav>
        <!-- Address Section -->
        <section id="address" class="container content-section text-center">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div v-for="addres in address" class="cadre">                      
                        <h2>
							{{ addres.name }} - {{addres.surname}} {{ addres.number }}
                            <a @click="edit(addres.id, $index)" href="#">
								<span class="fa fa-fw fa-pencil"></span>
                            </a>
                            <a @click="destroy(addres.id)" href="#address">
                                <span class="fa fa-fw fa-trash"></span>
                             </a>
                        </h2>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Change Address...</h4>
                    </div>
                    <div class="modal-body">

                        <form @submit.prevent="update" accept-charset="UTF-8" role="form">
                            <div class="row">

                                <div class="form-group col-lg-12" :class="{'has-error': error.updateContent}">
									<label for="lgFormGroupInput">Name:</label>
                                    <input v-model="updateData.content.name" class="form-control" name="name" id="name" required></textarea>
                                    <small class="help-block">{{ error.updateContent }}</small>
                                </div>
								<div class="form-group col-lg-12" :class="{'has-error': error.updateContent}">
									<label for="lgFormGroupInput">Surname:</label>
                                    <input v-model="updateData.content.surname" class="form-control" name="surname" id="surname" required></textarea>
                                    <small class="help-block">{{ error.updateContent }}</small>
                                </div>
								<div class="form-group col-lg-12" :class="{'has-error': error.updateContent}">
									<label for="lgFormGroupInput">Number:</label>
                                    <input v-model="updateData.content.number" class="form-control" name="number" id="number" required></textarea>
                                    <small class="help-block">{{ error.number }}</small>
                                </div>

                                <div class="form-group col-lg-12 text-center">                        
                                    <button type="button" class="btn btn-default"type="submit" data-dismiss="modal">Close</button>
                                    <input class="btn btn-default" type="submit" value="Save changes">
                                </div> 

                            </div>
                        </form>                         

                    </div>
                </div>
            </div>
        </div>
		
		
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="addModalLabel">Add Address...</h4>
                    </div>
                    <div class="modal-body">

                        <form @submit.prevent="send" accept-charset="UTF-8" role="form">
                            <div class="row">

                                <div class="form-group col-lg-12" :class="{'has-error': error.createContent}">
                                    <label for="lgFormGroupInput">Name:</label>
									<input v-model="createData.content.name" class="form-control" name="addname" id="addname" required></textarea>
                                    <small class="help-block">{{ error.createContent }}</small>
                                </div>
								<div class="form-group col-lg-12" :class="{'has-error': error.createContent}">
                                    <label for="lgFormGroupInput">Surname:</label>
									<input v-model="createData.content.surname" class="form-control" name="addsurname" id="addsurname" required></textarea>
                                    <small class="help-block">{{ error.createContent }}</small>
                                </div>
								<div class="form-group col-lg-12" :class="{'has-error': error.createContent}">
                                    <label for="lgFormGroupInput">Number:</label>
									<input v-model="createData.content.number" class="form-control" name="addnumber" id="addumber" required></textarea>
                                    <small class="help-block">{{ error.number }}</small>
                                </div>

                                <div class="form-group col-lg-12 text-center">                        
                                    <button type="button" class="btn btn-default"type="submit" data-dismiss="modal">Close</button>
                                    <input class="btn btn-default" type="submit" value="Add">
                                </div> 

                            </div>
                        </form>                         

                    </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <footer class="container">
            <div class="col-lg-10 col-lg-offset-1">
				<p><a @click="toShow = !toShow">Software under MIT License</a></p>
				<p>Copyright &copy; 2017 Gianluigi Mucciolo</p>
				<br>
				<div v-if="toShow">
					<p>Permission is hereby granted, free of charge, to any person obtaining a copy
					of this software and associated documentation files (the "Software"), to deal
					in the Software without restriction, including without limitation the rights
					to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
					copies of the Software, and to permit persons to whom the Software is
					furnished to do so, subject to the following conditions:</p>
					<br>
					<p>The above copyright notice and this permission notice shall be included in all
					copies or substantial portions of the Software.</p>
					<br>
					<p>THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
					IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
					FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
					AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
					LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
					OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
					SOFTWARE.</p>
				</div>
            </div>
        </footer>

        <!-- Vue.js JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.10/vue.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.17/vue-resource.min.js"></script> 
        <script src="js/app.js"></script> 

        <!-- Sweet Alert Javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> 

    </body>

</html>

