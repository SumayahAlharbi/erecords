<h3 Style="text-align:center;">Comj E-Records</h3>

@if (isset($searchResults_SIS))
  <table Style="width:100%; border-collapse: collapse; border: 1px solid black;">
      <tr>
        <th Style="border: 1px solid black; text-align:center; height: 50px;padding: 5px;">Student Name</th>
        <th Style="border: 1px solid black; text-align:center; height: 50px;padding: 5px;">Badge</th>
        <th Style="border: 1px solid black; text-align:center; height: 50px;padding: 5px;">National ID</th>
        <th Style="border: 1px solid black; text-align:center; height: 50px;padding: 5px;">Status</th>
        <th Style="border: 1px solid black; text-align:center; height: 50px;padding: 5px;">Student No</th>
        <th Style="border: 1px solid black; text-align:center; height: 50px;padding: 5px;">Batch</th>
        <th Style="border: 1px solid black; text-align:center; height: 50px;padding: 5px;">Stream</th>
      </tr>
      @foreach($searchResults_SIS as $result)
      <tr Style="border: 1px solid black; text-align:center;">

        <td Style="border-right: 1px solid black;text-align:center; padding: 5px;">{{$result->first_name50}} {{$result->last_name}}</td>
        <td Style="border-right: 1px solid black;text-align:center; padding: 5px;">{{$result->external_system_id}}</td>
        <td Style="border-right: 1px solid black;text-align:center; padding: 5px;">{{$result->national_id}}</td>
        <td Style="border-right: 1px solid black;text-align:center; padding: 5px;">{{$result->student_status}}</td>
        <td Style="border-right: 1px solid black;text-align:center; padding: 5px;">{{$result->campus_id}}</td>
        <td Style="border-right: 1px solid black;text-align:center; padding: 5px;">{{$result->batch}}</td>
        <td Style="border-right: 1px solid black;text-align:center; padding: 5px;">{{$result->stream}}</td>
      </tr>

      @endforeach
  </table>
@endif
