@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Edit Attachment
          </div>

          <div class="card-body">

                  @role('male-manager|female-manager')

                  <form method="POST" action="{{ route('student.edit_attachment',['sid'=>$attachment->student_id,'aid'=>$attachment->id])}}" enctype="multipart/form-data" class="form-horizontal">
                    @csrf

                    <input type="hidden" name="student_id" value="{{$attachment->student_id}}">
                    <input type="hidden" name="att_id" value="{{$attachment->id}}">

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Attachment Title</label>
                      <div class="col-md-6">
                        <input type="text" name="attch_title" id="attch_title" class="form-control{{ $errors->has('attch_title') ? ' is-invalid' : '' }}" value="{{$attachment->title}}" required autofocus>
                        @if ($errors->has('attch_title'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('attch_title') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Attachment File</label>
                      <div class="col-md-6">
                        <input type="file" name="attachment" id="attachment" class="form-control{{ $errors->has('attachment') ? ' is-invalid' : '' }}" required autofocus>
                        <span>image, pdf and word document</span>
                        @if ($errors->has('attachment'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('attachment') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </form>
                  @endrole
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
