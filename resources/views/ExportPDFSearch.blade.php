<h3 Style="text-align:center;">Comj E-Records</h3>

@if (isset($searchResults))
  <table Style="width:100%; border-collapse: collapse; border: 1px solid black;">
      <tr>
        <th Style="border: 1px solid black; text-align:center; height: 50px;">Student Name</th>
        <th Style="border: 1px solid black; text-align:center; height: 50px;">Badge</th>
        <th Style="border: 1px solid black; text-align:center; height: 50px;">National ID</th>
        <th Style="border: 1px solid black; text-align:center; height: 50px;">Status</th>
        <th Style="border: 1px solid black; text-align:center; height: 50px;">Student No</th>
        <th Style="border: 1px solid black; text-align:center; height: 50px;">Batch</th>
        <th Style="border: 1px solid black; text-align:center; height: 50px;">Stream</th>
      </tr>
      @foreach($searchResults as $result)
      <tr Style="border: 1px solid black; text-align:center;">

        <td Style="border-right: 1px solid black; padding: 5px;">{{$result->FirstName}} {{$result->LastName}}</td>
        <td Style="border-right: 1px solid black; padding: 5px;">{{$result->Badge}}</td>
        <td Style="border-right: 1px solid black; padding: 5px;">{{$result->NationalID}}</td>
        <td Style="border-right: 1px solid black; padding: 5px;">{{$result->Status}}</td>
        <td Style="border-right: 1px solid black; padding: 5px;">{{$result->StudentNo}}</td>
        <td Style="border-right: 1px solid black; padding: 5px;">{{$result->Batch}}</td>
        <td Style="border-right: 1px solid black; padding: 5px;">{{$result->Stream}}</td>
      </tr>

      @endforeach
  </table>
@endif
