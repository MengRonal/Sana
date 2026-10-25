@extends('layout.admin')

@section('content')

<div class="container">

    <div class="mb-3 d-flex justify-content-between align-items-center">

        <h3 class="mb-0">Settings</h3>

        <a href="{{ route('setting.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Add Setting
        </a>

    </div>

    @include('admin.message.message')

    <div class="card">
        <div class="card-body">

            <h3 class="mb-3">Setting</h3>

            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>Shop Name</th>
                        <th>Logo</th>
                        <th>Address</th>
                        <th>Tel</th>
                        <th>Exchange Rate</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($shop as $item)

                    <tr>

                        <td>{{ $item->shop_name }}</td>

                        <td>
                            @if($item->logo)
                                <img src="{{ asset('uploads/'.$item->logo) }}" width="60">
                            @endif
                        </td>

                        <td>{{ $item->address }}</td>

                        <td>{{ $item->tel }}</td>

                        <td>{{ $item->exchange_rate }}</td>

                        <td>
                            <a href="{{ route('setting.edit',$item->id) }}" class="text-primary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
<!-- ប៊ូតុងលុប (រក្សាទុកដដែល) -->
<a href="javascript:void(0)" class="text-danger delete-btn" data-url="{{ route('setting.delete', $item->id) }}"> 
    <i class="bi bi-trash"></i> 
</a>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const url = this.getAttribute('data-url');
            
            Swal.fire({
                title: 'តើអ្នកប្រាកដទេ?',
                text: "ទិន្នន័យនេះនឹងត្រូវលុបចោលជាអចិន្ត្រៃយ៍!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'បាទ/ចាស, លុបវា!',
                cancelButtonText: 'បោះបង់'
            }).then((result) => {
                if (result.isConfirmed) {
                    // បង្កើត Form មួយដើម្បី Submit ទៅកាន់ Controller តាមបែប Refresh ទំព័រ
                    const form = document.createElement('form');
                    form.action = url;
                    form.method = 'POST'; // ប្រើ POST ដើម្បីអាចភ្ជាប់ CSRF Token បាន

                    // និមិត្តសញ្ញាសុវត្ថិភាព CSRF Token របស់ Laravel
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    // ចងភ្ជាប់ទៅកាន់ body រួច Submit
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
});
</script>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">No Data</td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection