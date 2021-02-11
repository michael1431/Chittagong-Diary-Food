<!-- Brand Logo -->
<a href="{{ url('/') }}" class="brand-link bg-info">
    <img src="{{ asset('favicon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Ringer ERP 1.0</span>
</a>

<!-- Sidebar -->
<div class="sidebar nano">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('cdfilogo.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"> Chittagong Dairy Food </a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            {{--<li class="nav-item has-treeview {{ isActive(['/','dashboard*']) }}">--}}
            {{--<a href="#" class="nav-link {{ isActive(['dashboard*','/']) }}">--}}
            {{--<i class="nav-icon fas fa-tachometer-alt"></i>--}}
            {{--<p>--}}
            {{--Dashboard--}}
            {{--<i class="right fas fa-angle-left"></i>--}}
            {{--</p>--}}
            {{--</a>--}}
            {{--<ul class="nav nav-treeview">--}}
            {{--<li class="nav-item">--}}
            {{--<a href="{{ action('DashboardController@index') }}" class="nav-link {{ isActive('/') }}">--}}
            {{--<i class="far fa-circle nav-icon"></i>--}}
            {{--<p>Dashboard v1</p>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}

            <li class="nav-item {{ isActive(['/','dashboard*']) }}">
                <a href="{{ action('DashboardController@index') }}" class="nav-link {{ isActive('/') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        {{--<span class="right badge badge-danger">New</span>--}}
                    </p>
                </a>
            </li>

            {{-- Inventory UL Li Start --}}

            {{--<li class="nav-item has-treeview {{ isActive(['Inventory*']) }}">
                <a href="#" class="nav-link {{ isActive(['Inventory*']) }}">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>Inventory<i class="fas fa-angle-left right"></i> </p>
                </a>

                <ul class="nav nav-treeview" style="background-color: #292929">--}}

                    {{-- Menu Setup Start --}}
                    <li class="nav-item has-treeview {{ isActive(['Employee*']) }}">
                        <a href="#" class="nav-link {{ isActive('Employee/*') }}">
                            <i class="fas fa-man"></i>
                            <p>User Management<i class="fas fa-angle-left right"></i> </p>
                        </a>
                       
                        <ul class="nav nav-treeview">
                            @if(hasPermission(Auth::user()->role_id,'employee.add'))
                            <li class="nav-item">
                                <a href="{{ route('employee.add') }}" class="nav-link {{ isActive('Employee/add') }}">
                                    <p style="margin-left:30px">User List</p>
                                </a>
                            </li>
                            @endif
                        @if(hasPermission(Auth::user()->role_id,'user.roles.index'))
                            <li class="nav-item">
                                <a href="{{ route('user.roles.index') }}" class="nav-link {{ isActive('Employee/roles-add') }}">
                                    <p style="margin-left:30px">Role Management</p>
                                </a>
                            </li>
                        @endif
                        </ul>
                        
                    </li>
                    <li class="nav-item has-treeview {{ isActive(['Inventory/add-inventory-department*','Inventory/add-inventory-group*','Inventory/add-inventory-unit*']) }}">
                        <a href="#" class="nav-link {{ isActive(['Inventory/add-inventory-department*','Inventory/add-inventory-group*','Inventory/add-inventory-unit*']) }}">
                            <i class="fas fa-tools"></i>
                            <p> Menu Setup<i class="fas fa-angle-left right"></i> </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(hasPermission(Auth::user()->role_id,'warehouse.add'))
                            <li class="nav-item">
                                <a href="{{ route('warehouse.add') }}" class="nav-link {{ isActive('add-warehouse') }}">
                                    <p style="margin-left:30px">Warehosue</p>
                                </a>
                            </li>
                            @endif
                            @if(hasPermission(Auth::user()->role_id,'cost.add'))
                            <li class="nav-item">
                                <a href="{{ route('cost.add') }}" class="nav-link {{ isActive('add-cost') }}">
                                    <p style="margin-left:30px">Cost Setup</p>
                                </a>
                            </li>
                            @endif
                            @if(hasPermission(Auth::user()->role_id,'inventory.department.add'))
                            <li class="nav-item">
                                <a href="{{ route('inventory.department.add') }}" class="nav-link {{ isActive('Inventory/add-inventory-department') }}">
                                    <p style="margin-left:30px">Product Type</p>
                                </a>
                            </li>
                            @endif
                            @if(hasPermission(Auth::user()->role_id,'inventory.group.add'))
                            <li class="nav-item">
                                <a href="{{ route('inventory.group.add') }}" class="nav-link {{ isActive('Inventory/add-inventory-group') }}">
                                    <p style="margin-left:30px">Group</p>
                                </a>
                            </li>
                            @endif
                            @if(hasPermission(Auth::user()->role_id,'inventory.unit.add'))
                            <li class="nav-item">
                                <a href="{{ route('inventory.unit.add') }}" class="nav-link {{ isActive('Inventory/add-inventory-unit') }}">
                                    <p style="margin-left:30px">Unit</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    {{-- Menu Setup End --}}

                    {{-- Menu Setup Start --}}

                    <li class="nav-item has-treeview {{ isActive(['Inventory/add-inventory-supplier']) }}">
                        <a href="#" class="nav-link {{ isActive('Inventory/add-inventory-supplier') }}">
                            <i class="fas fa-users"></i>
                            <p> Supplier Management<i class="fas fa-angle-left right"></i> </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(hasPermission(Auth::user()->role_id,'inventory.supplier.add'))
                            <li class="nav-item">
                                <a href="{{ route('inventory.supplier.add') }}" class="nav-link {{ isActive('Inventory/add-inventory-supplier') }}">
                                    <p style="margin-left:30px">Suppliers</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    {{-- Menu Setup End --}}

                    {{-- Item Create Start --}}
                    <li class="nav-item has-treeview {{ isActive(['Inventory/add-inventory-item*']) }}">
                        <a href="#" class="nav-link {{ isActive('settings/*') }}">
                            <i class="fas fa-sitemap"></i>
                            <p> Item Management<i class="fas fa-angle-left right"></i> </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(hasPermission(Auth::user()->role_id,'inventory.item.add'))
                            <li class="nav-item">
                                <a href="{{ route('inventory.item.add') }}" class="nav-link {{ isActive('Inventory/add-inventory-item') }}">
                                    <p style="margin-left:30px">Item Create & View </p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    {{-- Item Create End --}}

                    {{-- Requistiion Manage Start --}}

                    <li class="nav-item has-treeview {{ isActive(['Inventory/add-inventory-requisition','Inventory/view-purchase-requisition*','Inventory/after-check-purchase-requisition']) }}">
                        <a href="#" class="nav-link {{ isActive(['Inventory/view-purchase-requisition/*','Inventory/add-inventory-requisition','Inventory/after-check-purchase-requisition']) }}">
                            <i class="fas fa-money"></i>
                            <p>Requisition Management<i class="fas fa-angle-left right"></i> </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(hasPermission(Auth::user()->role_id,'inventory.requisition.add'))
                            <li class="nav-item">
                                <a href="{{ route('inventory.requisition.add') }}" class="nav-link {{ isActive('Inventory/add-inventory-requisition') }}">
                                    <p style="margin-left:30px">Create Requisition</p>
                                </a>
                            </li>
                            @endif
                            @if(hasPermission(Auth::user()->role_id,'inventory.purchase-requisition.view'))
                            <li class="nav-item">
                                <a href="{{ route('inventory.purchase-requisition.view') }}" class="nav-link {{ isActive('Inventory/view-purchase-requisition') }}">
                                    <p style="margin-left:30px">All Requisition</p>
                                </a>
                            </li>
                            @endif
                            @if(hasPermission(Auth::user()->role_id,'purchase.requisition.after.check'))
                            <li class="nav-item">
                                <a href="{{ route('purchase.requisition.after.check') }}" class="nav-link {{ isActive('Inventory/after-check-purchase-requisition') }}">
                                    <p style="margin-left:30px">After Checking Requisition</p>
                                </a>

                            </li>
                            @endif
                        </ul>
                    </li>

                   

                    {{-- Requistiion Manage End--}}

                    {{-- Purchase Management Start --}}
                    <li class="nav-item has-treeview {{ isActive(['Inventory/add-inventory-requisition-purchase*','Inventory/list-inventory-requisition-purchase*','Inventory/add-inventory-requisition-purchase*','Inventory/purchase-order*','Inventory/purchase-summary*','Inventory/requisition-quotation*']) }}">
                        <a href="#" class="nav-link {{ isActive(['Inventory/add-inventory-requisition-purchase*','Inventory/list-inventory-requisition-purchase*','Inventory/add-inventory-requisition-purchase*','Inventory/purchase-order*','Inventory/purchase-summary*','Inventory/requisition-quotation*']) }}">
                            <i class="fas fa-money"></i>
                            <p>Purchase Management<i class="fas fa-angle-left right"></i> </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(hasPermission(Auth::user()->role_id,'inventory.requisition.purchase'))
                                <li class="nav-item">
                                    <a href="{{ route('inventory.requisition.purchase') }}" class="nav-link {{ isActive('Inventory/add-inventory-requisition-purchase') }}">
                                        <p style="margin-left:30px">Pending Purchase</p>
                                    </a>
                                </li>
                            @endif
                            @if(hasPermission(Auth::user()->role_id,'inventory.requisition.quotation.list'))
                            <li class="nav-item">
                                <a href="{{ route('inventory.requisition.quotation.list') }}" class="nav-link {{ isActive('Inventory/requisition-quotation') }}">
                                    <p style="margin-left:30px">All Requisition Quotation</p>
                                </a>
                            </li>
                            @endif
                            @if(hasPermission(Auth::user()->role_id,'inventory.order.purchase'))
                            <li class="nav-item">
                                <a href="{{ route('inventory.order.purchase') }}" class="nav-link {{ isActive('Inventory/purchase-order') }}">
                                    <p style="margin-left:30px">Make Purchase Order </p>
                                </a>
                            </li>
                            @endif
                            @if(hasPermission(Auth::user()->role_id,'inventory.purchase.summary'))
                            <li class="nav-item">
                                <a href="{{ route('inventory.purchase.summary') }}" class="nav-link {{ isActive('Inventory/purchase-summary') }}">
                                    <p style="margin-left:30px">Purchase Order Summary </p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    {{-- Order Management End --}}
                    <li class="nav-item has-treeview {{ isActive(['Sales*']) }}">
                            <a href="#" class="nav-link {{ isActive('Sales/*') }}">
                                <i class="fas fa-money"></i>
                                <p> Order Management<i class="fas fa-angle-left right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
    
                            @if(hasPermission(Auth::user()->role_id,'view-order'))
                            <li class="nav-item">
                                    <a href="{{ route('view-order') }}" class="nav-link {{ isActive('Sales/view-order') }}">
                                        <p style="margin-left:30px">View Order List</p>
                                    </a>
                                </li>
                                @endif
                                @if(hasPermission(Auth::user()->role_id,'view-order'))
                                <li class="nav-item">
                                    <a href="{{ route('view-order',['custom_order=1']) }}" class="nav-link {{ isActive('Sales/view-order') }}">
                                        <p style="margin-left:30px">Create Order</p>
                                    </a>
                                
    
                                    {{-- <a href="{{ url('Inventory/view-purchase-requisition') }}" class="nav-link {{ isActive('Inventory/view-purchase-requisition') }}">
                                        <p style="margin-left:30px">All Requisition</p>
                                    </a>
    
                                    <a href="{{ url('Inventory/after-check-purchase-requisition') }}" class="nav-link {{ isActive('Inventory/after-check-purchase-requisition') }}">
                                        <p style="margin-left:30px">After Checking Requisition</p>
                                    </a> --}}
    
                                </li>
                                @endif
                            </ul>
                        </li>
                        


            {{-- Goods In  Start --}}
            <li class="nav-item has-treeview {{ isActive(['add-goodsin','lc-cost','goodsin_out_create']) }}">
                <a href="#" class="nav-link {{ isActive(['add-goodsin','lc-cost','goodsin_out_create']) }}">
                    <i class="fas fa-money"></i>
                    <p> Goods In Management<i class="fas fa-angle-left right"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                @if(hasPermission(Auth::user()->role_id,'goodsin.add'))
                <li class="nav-item">
                        <a href="{{ route('goodsin.add') }}" class="nav-link {{ isActive('add-goodsin') }}">
                            <p style="margin-left:30px">Add Goods In Stock</p>
                        </a>
                    </li>
                    @endif
                    @if(hasPermission(Auth::user()->role_id,'inventory.goodsin_out.create'))
                    <li class="nav-item">
                        <a href="{{ route('inventory.goodsin_out.create') }}" class="nav-link {{ isActive('goodsin_out_create') }}">
                            <p style="margin-left:30px">Raw To FinishGoods</p>
                        </a>
                    </li>
                    @endif
                    @if(hasPermission(Auth::user()->role_id,'lc.cost'))
                    <li class="nav-item">
                        <a href="{{ route('lc.cost') }}" class="nav-link {{ isActive('lc-cost') }}">
                            <p style="margin-left:30px">Expense Register</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>

            {{-- Goods in End --}}


            {{-- LC Report View Start --}}
            <li class="nav-item has-treeview {{ isActive(['lc-report','view-stock','Report/invoiceList','Report/Dues-Status','Report/IncomeExpense-Status','Report/Income-Status']) }}">
                <a href="#" class="nav-link {{ isActive(['lc-report','view-stock','Report/invoiceList','Report/Dues-Status','Report/IncomeExpense-Status','Report/Income-Status']) }}">
                    <i class="fas fa-money"></i>
                        <p>Reports<i class="fas fa-angle-left right"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                   
                    @if(hasPermission(Auth::user()->role_id,'parties.status'))
                    <li class="nav-item">
                        <a href="{{ route('parties.status') }}" class="nav-link {{ isActive('Report/Dues-Status') }}">
                            <p style="margin-left:30px">Dues Report </p>
                        </a>
                    </li>
                    @endif
                    @if(hasPermission(Auth::user()->role_id,'lc.report'))
                    <li class="nav-item">
                        <a href="{{ route('lc.report') }}" class="nav-link {{ isActive('lc-report') }}">
                            <p style="margin-left:30px">LCwise Report </p>
                        </a>
                    </li>
                    @endif
                    @if(hasPermission(Auth::user()->role_id,'stock.view'))
                    <li class="nav-item">
                        <a href="{{ route('stock.view') }}" class="nav-link {{ isActive('view-stock') }}">
                            <p style="margin-left:30px">Stock Status</p>
                        </a>
                    </li>
                    @endif
                    @if(hasPermission(Auth::user()->role_id,'invoice.list'))
                    <li class="nav-item">
                        <a href="{{ route('invoice.list') }}" class="nav-link {{ isActive('Report/invoiceList') }}">
                            <p style="margin-left:30px">Invoice List</p>
                        </a>
                    </li>
                    @endif
                    @if(hasPermission(Auth::user()->role_id,'income_expense.status'))
                    <li class="nav-item">
                        <a href="{{ route('income_expense.status') }}" class="nav-link {{ isActive('Report/IncomeExpense-Status') }}">
                            <p style="margin-left:30px">Income Status</p>
                        </a>
                    </li>
                    @endif
                    @if(hasPermission(Auth::user()->role_id,'income.status'))
                    <li class="nav-item">
                        <a href="{{ route('income.status') }}" class="nav-link {{ isActive('Report/Income-Status') }}">
                            <p style="margin-left:30px">Annual Income Statement</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>


            {{-- LC Report View Start --}}
            {{-- <li class="nav-item has-treeview {{ isActive(['view-stock*']) }}">
                <a href="#" class="nav-link {{ isActive(['view-stock*']) }}">
                    <i class="fas fa-money"></i>
                    <p>Stock Report<i class="fas fa-angle-left right"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    
                </ul>
            </li> --}}


        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
