@extends('dashboard.layouts.main')

@section('container')
<div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-info text-white me-2">
        <i class="mdi mdi-account-multiple"></i>
      </span> Survey Kepuasan
    </h3>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('survey.report') }}" class="mb-4">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Mulai:</label>
                            <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Akhir:</label>
                            <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Survey</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($surveys as $index => $survey)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $survey->created_at->format('d M Y') }}</td>
                            <td>
                                @if ($survey->response == 3)
                                    😃 Sangat Puas
                                @elseif ($survey->response == 2)
                                    🙂 Puas
                                @else
                                    😐 Kurang Puas
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">Tidak ada data survey.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
