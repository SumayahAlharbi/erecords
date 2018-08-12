<h1>Search Result</h1>

@if (isset($searchResults))
  <table>
      <tr><th></th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Badge</th>
        <th>National ID</th>
        <th>Status</th>
        <th>Student No</th>
        <th>Batch</th>
        <th>Stream</th>
      </tr>
      @foreach($searchResults as $result)
      <tr>

        <td>{{$result->FirstName}}</td>
        <td>{{$result->LastName}}</td>
        <td>{{$result->Badge}}</td>
        <td>{{$result->NationalID}}</td>
        <td>{{$result->Status}}</td>
        <td>{{$result->StudentNo}}</td>
        <td>{{$result->Batch}}</td>
        <td>{{$result->Stream}}</td>
      </tr>

      @endforeach
  </table>
@endif
