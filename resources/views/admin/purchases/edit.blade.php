<form action="{{route('purchases.update',$purchase->id)}}" method="POST">

@csrf

@method('PUT')