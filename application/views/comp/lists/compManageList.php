<div class="mLeftContainer">
    <div class="recentActivity">
        <div class="arrow">&nbsp;</div>                       
        <h3 class="title" style="margin-top: -12px;"><i class="icon-list"></i> Manage List</h3><br clear="all"/>
        <span id="titleDes">Manage your lists </span>
        <hr/>

        <div class="ajax-content">

        </div>

        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a onclick="loadList()" href="#home" data-toggle="tab">All Lists</a></li>
            <li><a href="#addnew" data-toggle="tab">Create New</a></li>

        </ul>

        <?php
        //debugPrint($profile);
        ?>
        <div class="tab-content">
            <div class="tab-pane active" id="home">
                <div class="panel panel-default" style="margin-top: 2px;">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><i class="icon-list"></i> My lists</div>

                    <!-- Table -->
                    <table class="table">

                        <thead>
                            <tr>
                                <td>List Name</td>
                                <td>Added Date</td>
                            </tr>
                        </thead>
                        <tbody id="myLists">
                            
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
            <div class="tab-pane" id="addnew">

                <div class="panel panel-default" style="margin-top: 2px;">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><i class="icon-step-forward"></i> Add new list</div>

                    <!-- Table -->
                    <form id="newList" action="" method="post" onsubmit="return addNewList()">
                        <table class="table">
                            <tr>
                                <td style="width: 200px;">List Name</td>
                                <td><input type="text" name="list-name" placeholder="List name"/></td>
                                <td><span class="error"></span></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input class="btn btn-info" type="submit" name="submit" value="Add"/></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>
        </div>

        <script>
            $(function() {
                $('#myTab a[href="#addnew"]').tab('show')
            })
        </script>



    </div>
</div>
