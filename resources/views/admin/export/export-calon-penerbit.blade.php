<table class="table" id="tabel">
    <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Perusahaan</th>
                                                        <th>Brand</th>
                                                        <th>Phone</th>
                                                        <th>Tanggal</th>
                                                        <th>Vote</th>
                                                        <th>Like</th>
                                                        <th>Comment</th>
                                                        <th>Kebutuhan Data</th>
                                                        <th>Rencana Invest</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
<tbody>
    @php $no = 0; @endphp
    @foreach($emiten as $row)
         @php $no++; @endphp
         <?php 
            $status = \DB::table('emiten_status_histories')->where('emiten_id', $row->id)
               ->select('status')->orderBy('id', 'DESC')->limit(1)
               ->first();

            $investment = \DB::table('emiten_pre_investment_plans')->where('emiten_id', $row->id)
                ->where('is_deleted', 0)
                ->select(\DB::raw('COALESCE(SUM(amount),0) as investment'))
                ->first();

            $total_likes = \DB::table('emiten_votes')->where('likes', 1)
                ->where('emiten_id', $row->id)
                ->where('is_deleted', 0)
                ->select(\DB::raw('COUNT(likes) as total_likes'))
                ->first();

            $total_votes = \DB::table('emiten_votes')->where('vote', 1)
                ->where('emiten_id', $row->id)
                ->where('is_deleted', 0)
                ->select(\DB::raw('COUNT(vote) as total_votes'))
                ->first();
            
            $statusVerifikasi = "";
                if($row->is_verified_bisnis == 1){
                    $statusVerifikasi = "Terverifikasi";
                }else if($row->is_verified_bisnis == 2){
                    $statusVerifikasi = "Ditolak";
                }else if($row->is_verified_bisnis == null){
                    $statusVerifikasi = "";
                }

            $totalComents = \DB::select('(SELECT COALESCE(COUNT(comment), 0) + COALESCE(COUNT(ch.comment_histories), 0) as total_coments from emiten_comments left join (select emiten_comment_id, COUNT(comment) as comment_histories from emiten_comment_histories where is_deleted = 0 group by id) as ch on emiten_comments.id = ch.emiten_comment_id where emiten_comments.emiten_id = '.$row->id.' and emiten_comments.is_deleted = 0)');
         ?>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $row->trader_name }}</td>
            <td>{{ $row->company_name }}</td>
            <td>{{ $row->trademark }}</td>
            <td>{{ $row->phone }}</td>
            <td>{{ tgl_indo(date('Y-m-d', strtotime($row->created_at))) }}</td>
            <td>{{ $total_votes->total_votes }}</td>
            <td>{{ $total_likes->total_likes }}</td>
            <td>{{ $totalComents[0]->total_coments }}</td>
            <td>{{ rupiahBiasa($row->capital_needs) }}</td>
            <td>{{ rupiahBiasa($investment->investment) }}</td>
            <td>{{ $statusVerifikasi }}</td>
        </tr>
    @endforeach
</tbody>
</table>