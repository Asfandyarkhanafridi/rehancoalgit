<div class="container">
    <h1>Company list</h1>
    <table border="1" cellpadding="10" width="100%" style="margin-bottom: 100px;">
        <tr>
            <th width="20%">ID</th>
            <th width="40%">Name</th>
        </tr>
        @foreach($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->company_name }}</td>
            </tr>
        @endforeach
    </table>
</div>
