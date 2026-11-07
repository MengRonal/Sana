@extends('layout.admin')

@section('content')
<!-- Toast Alert Notification -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">
    @if (Session::has('success_login'))
    <div class="toast js-auto-toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <strong>Success:</strong> {{ session('success_login') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    @elseif(Session::has('error'))
    <div class="toast js-auto-toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <strong>Error:</strong> {{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    @endif
</div>

<!-- 📊 1. FINANCIAL OVERVIEW CARDS (កាតហិរញ្ញវត្ថុ ៤ ប្រភេទ) -->
<div class="row">
  <!-- Total Sales -->
  <div class="col-md-3 grid-margin stretch-card">
    <div class="card card-statistics bg-primary text-white">
      <div class="card-body">
        <div class="d-flex flex-row justify-content-between align-items-center">
          <div class="statistics-item">
            <p class="text-white mb-1">Total Sales</p>
            <h3 class="font-weight-bold mb-0">${{ number_format($totalSales ?? 0, 2) }}</h3>
          </div>
          <div class="icon-circle bg-white text-primary rounded-circle p-3">
            <i class="mdi mdi-cart-outline mdi-24px"></i>
          </div>
        </div>
        <small class="text-white-50 mt-2 d-block">លក់សរុបពីប្រព័ន្ធ POS</small>
      </div>
    </div>
  </div>

  <!-- Gross Profit -->
  <div class="col-md-3 grid-margin stretch-card">
    <div class="card card-statistics bg-success text-white">
      <div class="card-body">
        <div class="d-flex flex-row justify-content-between align-items-center">
          <div class="statistics-item">
            <p class="text-white mb-1">Gross Profit</p>
            <h3 class="font-weight-bold mb-0">${{ number_format($totalGrossProfit ?? 0, 2) }}</h3>
          </div>
          <div class="icon-circle bg-white text-success rounded-circle p-3">
            <i class="mdi mdi-trending-up mdi-24px"></i>
          </div>
        </div>
        <small class="text-white-50 mt-2 d-block">ចំណេញពីការលក់</small>
      </div>
    </div>
  </div>

  <!-- Expenses -->
  <div class="col-md-3 grid-margin stretch-card">
    <div class="card card-statistics bg-danger text-white">
      <div class="card-body">
        <div class="d-flex flex-row justify-content-between align-items-center">
          <div class="statistics-item">
            <p class="text-white mb-1">Total Expenses</p>
            <h3 class="font-weight-bold mb-0">${{ number_format($totalExpense ?? 0, 2) }}</h3>
          </div>
          <div class="icon-circle bg-white text-danger rounded-circle p-3">
            <i class="mdi mdi-cash-refund mdi-24px"></i>
          </div>
        </div>
        <small class="text-white-50 mt-2 d-block">ចំណាយសរុប (កត់ត្រាដៃ)</small>
      </div>
    </div>
  </div>

  <!-- Net Profit -->
  <div class="col-md-3 grid-margin stretch-card">
    <div class="card card-statistics bg-warning text-white">
      <div class="card-body">
        <div class="d-flex flex-row justify-content-between align-items-center">
          <div class="statistics-item">
            <p class="text-white mb-1">Net Profit</p>
            <h3 class="font-weight-bold mb-0">${{ number_format($netProfit ?? 0, 2) }}</h3>
          </div>
          <div class="icon-circle bg-white text-warning rounded-circle p-3">
            <i class="mdi mdi-wallet mdi-24px"></i>
          </div>
        </div>
        <small class="text-white-50 mt-2 d-block">ចំណេញសុទ្ធចុងក្រោយ</small>
      </div>
    </div>
  </div>
</div>

<!-- 📈 2. SECONDARY CARDS (Orders & Other Income) -->
<div class="row mb-4">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h5 class="card-title text-muted mb-1">Total Orders (ចំនួនការលក់)</h5>
          <h2 class="font-weight-bold mb-0 text-dark">{{ number_format($totalOrders ?? 0) }} Orders</h2>
        </div>
        <a href="{{ route('admin.olders') }}" class="btn btn-outline-primary btn-fw">View Orders</a>
      </div>
    </div>
  </div>

  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h5 class="card-title text-muted mb-1">Total Other Income (ចំណូលផ្សេងៗ)</h5>
          <h2 class="font-weight-bold mb-0 text-success">${{ number_format($totalOtherIncome ?? 0, 2) }}</h2>
        </div>
        <a href="{{ route('admin.incomes') }}" class="btn btn-outline-success btn-fw">View Other Income</a>
      </div>
    </div>
  </div>
</div>

<!-- 🛒 3. LIVE POS STREAM (កូដ Ticker ចាស់របស់អ្នក) -->
<div class="row g-4 mt-2">
    <div class="col-12 col-lg-7">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold m-0 text-dark">Peak Sales Hours</h5>
                <span class="badge bg-light text-secondary">Today</span>
            </div>
            <div style="height: 280px; position: relative;">
                <canvas id="peakSalesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Right Column: Live POS Ticker -->
    <div class="col-12 col-lg-5">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h5 class="fw-bold mb-3 text-dark">Live POS Stream</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light fs-7 text-uppercase">
                        <tr>
                            <th>Item</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="fs-7">
                        <tr>
                            <td><strong>1x Iced Caramel Latte</strong></td>
                            <td><span class="badge bg-info-subtle text-info">Takeaway</span></td>
                            <td><span class="spinner-grow spinner-grow-sm text-warning" role="status"></span> Brewing</td>
                        </tr>
                        <tr>
                            <td><strong>2x Espresso, 1x Croissant</strong></td>
                            <td><span class="badge bg-purple-subtle text-purple">Table 4</span></td>
                            <td><span class="badge bg-success-subtle text-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td><strong>1x Matcha Latte (Oat)</strong></td>
                            <td><span class="badge bg-info-subtle text-info">App Order</span></td>
                            <td><span class="badge bg-success-subtle text-success">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection