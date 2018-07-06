@extends('_reports.app')
@section('title', 'SYSTEM')
@section('content')

    <table>
        <thead>
          <tr  style="background-color: #f1f1f1; color: #2a3f54; text-align: center;">
              <th>No</th>
              <th>Name</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($data as $key => $value)
              <tr>
                <td style="background-color: #f1f1f1; text-align: center;">{{ $loop->iteration }}</td>
                <th>{{ $value->name }}</th>
              </tr>
          @endforeach
      </tbody>
    </table>

@endsection
