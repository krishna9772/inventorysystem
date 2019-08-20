<!--

  ----For  Accounts Sidebar Panel----

 -->
<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a href="#collapseAdmin" data-parent="#accordion" data-toggle="collapse">
        <span class="glyphicon glyphicon-user"></span> 
        Accounts
      </a>
    </h4>
  </div>
  <div class="panel-collapse collapse" id="collapseAdmin">
    <div class="panel-body">
      <table class="table">
        <tbody>
          <tr>
            <td>
              <span class="glyphicon glyphicon-plus text-primary"></span><?php echo anchor('account/signup',' Add New User');?>
            </td>
          </tr>
          <tr>
            <td>
              <span class="glyphicon glyphicon-user text-primary"></span><?php echo anchor('account/edit_user/'.$this->session->userdata('ba_user_id'),' Edit Profile');?>
            </td>
          </tr>
          <tr>
            <td>
              <span class="glyphicon glyphicon-arrow-right text-primary"></span><?php echo anchor('account/users',' Users List');?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
 </div>

  <!--

    ----For Customer Sidebar Panel

  -->
 <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse">
              <span class="glyphicon glyphicon-inbox"></span> 
              Customer
            </a>
          </h4>
        </div>
        <div class="panel-collapse collapse" id="collapseOne">
          <div class="panel-body">
            <table class="table">
              <tbody>
                <tr>
                  <td>
                    <span class="glyphicon glyphicon-inbox text-primary"></span><?php echo anchor('customer_con/add_Customer',' Add new Customer');?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="glyphicon glyphicon-arrow-right text-primary"></span><?php echo anchor('customer_con/fetch_Customer',' Customer List');?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

 <!--

    ----For Products Sidebar Panel

  -->
 <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a href="#collapseproduct" data-parent="#accordion" data-toggle="collapse">
              <span class="glyphicon glyphicon-plus"></span> 
              Products
            </a>
          </h4>
        </div>
        <div class="panel-collapse collapse" id="collapseproduct">
          <div class="panel-body">
            <table class="table">
              <tbody>
                <tr>
                  <td>
                    <span class="glyphicon glyphicon-inbox text-primary"></span><?php echo anchor('product_con/add_Product',' Add new Product');?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="glyphicon glyphicon-arrow-right text-primary"></span><?php echo anchor('product_con/fetch_Product',' Product List');?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>


 <!--

  ----For  Category Sidebar Panel----

 -->
 <div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a href="#collapsecategory" data-parent="#accordion" data-toggle="collapse">
        <span class="glyphicon glyphicon-folder-close"></span> 
        Principle Company
      </a>
    </h4>
  </div>
  <div class="panel-collapse collapse" id="collapsecategory">
    <div class="panel-body">
      <table class="table">
        <tbody>
          <tr>
            <td>
              <span class="glyphicon glyphicon-plus text-primary"></span><?php echo anchor('category_con/add_Category',' Add new Company');?>
            </td>
          </tr>
          <tr>
            <td>
              <span class="glyphicon glyphicon-arrow-right text-primary"></span><?php echo anchor('category_con/fetch_Category','Company List');?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

 <!--

  ----For  Brand Sidebar Panel----

 -->
 <div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a href="#collapsebrand" data-parent="#accordion" data-toggle="collapse">
        <span class="glyphicon glyphicon-folder-open"></span> 
        Distributor Company
      </a>
    </h4>
  </div>
  <div class="panel-collapse collapse" id="collapsebrand">
    <div class="panel-body">
      <table class="table">
        <tbody>
          <tr>
            <td>
              <span class="glyphicon glyphicon-file text-primary"></span><?php echo anchor('brand_con/add_Brand',' Add new Company');?>
            </td>
          </tr>
          <tr>
            <td>
              <span class="glyphicon glyphicon-arrow-right text-primary"></span><?php echo anchor('brand_con/fetch_Brand','Company List');?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!--

  ----For  Order Sidebar Panel----

 -->
 <div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a href="#collapseorder" data-parent="#accordion" data-toggle="collapse">
        <span class="glyphicon glyphicon-book"></span> 
        Order
      </a>
    </h4>
  </div>
  <div class="panel-collapse collapse" id="collapseorder">
    <div class="panel-body">
      <table class="table">
        <tbody>
          <tr>
            <td>
              <span class="glyphicon glyphicon-plus text-primary"></span><?php echo anchor('order_con/add_Order','Make a new order');?>
            </td>
          </tr>
          <tr>
            <td>
              <span class="glyphicon glyphicon-arrow-right text-primary"></span><?php echo anchor('order_con/fetch_Order','Order List');?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
 </div>
