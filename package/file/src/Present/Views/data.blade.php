<!DOCTYPE html>
<html>
<head>
    <style>
        *{
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        body{
            font-family: DejaVu Sans, sans-serif; 
            -webkit-font-smoothing: antialiased;
            background: #bbbfc4;
        }

        .table-wrapper{
            margin: 1px;
        }

        .fl-table {
            border-radius: 5px;
            font-size: 12px;
            font-weight: normal;
            width: 100%;
            background-color: white;
        }

        .fl-table td, .fl-table th {
            text-align: center;
            padding: 8px;
        }

        .fl-table td {
            border-right: 1px solid #e7e6e6;
            font-size: 12px;
            word-wrap: break-word;
        }

        .fl-table thead th {
            color: #ffffff;
            background: #4FC3A1;
        }


        .fl-table thead th:nth-child(odd) {
            color: #ffffff;
            background: #324960;
        }

        .fl-table tr:nth-child(even) {
            background: rgb(236, 236, 236);
        }
    </style>
</head>
<body>
    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    @foreach ($columns as $column)
                        <th>{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td>{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
