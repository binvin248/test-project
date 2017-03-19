<?php


// algo

// leclab or sb
	
	// midterm and finals

	// get lectures grade written
	// get lectures grade performance
	// get lectures grade major

	// get lab grade written
	// get lab grade perf
	// get lab grade major

	// get average of written, perf and major exam
	
	// * lec grades
	// compute lec written * .20
	// compute lec perf * .60
	// compute lec major * .20

	// * lab grades
	// compute lab written * .20
	// compute lab perf * .60
	// compute lab major * .20
	
	// compute sum of lec grades
	// compute sum of lab grades
	
	// get percentage sum of lec grades (40%)
	// get percentage sum of lab grades (60%)
	// compute sum of lec and lab grades 
	
	// * midterm and final grade
	// midterm grade sum of lec and lab grades * .40
	// final grade sum of lec and lab grades * .60
	
	// final grade = midterm + final grade


$mg_per = 0.40;

$fg_per = 0.60;

if($crse_type_two == "lec")

{

	$written_per = 0.25;
	$perf_per = 0.45;
	$major_per = 0.30;

}

elseif($crse_type_two == "leclab" or $crse_type_two == "sb")

{

	$written_per = 0.20;
	$perf_per    = 0.60;
	$major_per = 0.20;

}
else

{

	$written_per = 0.20;
	$perf_per    = 0.50;
	$major_per = 0.30;

}


// if leclab or sb

if($crse_type_two == "leclab" or $crse_type_two == "sb")

{

	// leclab or sb / midterm written lecture {start}

	$s_mwle = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'midterm' AND area = 'written' and exam='lecture'";

	$r_s_mwle  = $conn->query($s_mwle);

	if($r_s_mwle->num_rows > 0){

	    while($row_mwle = $r_s_mwle->fetch_assoc()) {

	        $arr_mwle[] = $row_mwle["grade"];

	    }

	    $no_mwle = count($arr_mwle);

	    $sum_mwle =  array_sum($arr_mwle);

	    $mwle_grade = $sum_mwle/$no_mwle;

	}else{

	    $mwle_grade = "";

	}

	// leclab or sb / midterm performance lecture

	$s_mple = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'midterm' AND area = 'performance' and exam='lecture'";
	$r_s_mple  = $conn->query($s_mple);
	if($r_s_mple->num_rows > 0){


	    while($row_mple = $r_s_mple->fetch_assoc()) {

	        $arr_mple[] = $row_mple["grade"];

	    }

	    $no_mple = count($arr_mple);

	    $sum_mple =  array_sum($arr_mple);

	    $mple_grade = $sum_mple/$no_mple;

	}else{

	    $mple_grade = "";

	}

	// leclab or sb / midterm major lecture

	$s_mmle = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'midterm' AND area = 'major' and exam='lecture'";
	$r_s_mmle  = $conn->query($s_mmle);
	if($r_s_mmle->num_rows > 0){


	    while($row_mmle = $r_s_mmle->fetch_assoc()) {

	        $arr_mmle[] = $row_mmle["grade"];

	    }

	    $no_mmlee = count($arr_mmle);

	    $sum_mmle =  array_sum($arr_mmle);

	    $mmle_grade = $sum_mmle/2;

	}else{

	    $mmle_grade = "";

	}

	// leclab or sb / midterm written laboratory

	$s_mwla = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'midterm' AND area = 'written' and exam='laboratory'";
	$r_s_mwla  = $conn->query($s_mwla);
	if($r_s_mwla->num_rows > 0){


	    while($row_mwla = $r_s_mwla->fetch_assoc()) {

	        $arr_mwla[] = $row_mwla["grade"];

	    }

	    $no_mwla = count($arr_mwla);

	    $sum_mwla =  array_sum($arr_mwla);

	    $mwla_grade = $sum_mwla/$no_mwla;

	}else{

	    $mwla_grade = "";

	}

	// leclab or sb / midterm performance laboratory

	$s_mpla = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'midterm' AND area = 'performance' and exam='laboratory'";
	$r_s_mpla  = $conn->query($s_mpla);
	if($r_s_mpla->num_rows > 0){


	    while($row_mpla = $r_s_mpla->fetch_assoc()) {

	        $arr_mpla[] = $row_mpla["grade"];

	    }

	    $no_mpla = count($arr_mpla);

	    $sum_mpla =  array_sum($arr_mpla);

	    $mpla_grade = $sum_mpla/$no_mpla;

	}else{

	    $mpla_grade = "";

	}

	// leclab or sb / midterm major laboratory

	$s_mmla = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'midterm' AND area = 'major' and exam='laboratory'";
	$r_s_mmla  = $conn->query($s_mmla);
	if($r_s_mmla->num_rows > 0){


	    while($row_mmla = $r_s_mmla->fetch_assoc()) {

	        $arr_mmla[] = $row_mmla["grade"];

	    }

	    $no_mmla = count($arr_mmla);

	    $sum_mmla =  array_sum($arr_mmla);

	    $mmla_grade = $sum_mmla/2;

	}else{

	    $mmla_grade = "";

	}

	// leclab or sb / midterm major laboratory {end}

	// leclab or sb / final major laboratory {start}

	// leclab or sb / final major lecture

	$s_fwle = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'final' AND area = 'written' and exam='lecture'";
	$r_s_fwle  = $conn->query($s_fwle);
	if($r_s_fwle->num_rows > 0){


	    while($row_fwle = $r_s_fwle->fetch_assoc()) {

	        $arr_fwle[] = $row_fwle["grade"];

	    }

	    $no_fwle = count($arr_fwle);

	    $sum_fwle =  array_sum($arr_fwle);

	    $fwle_grade = $sum_fwle/$no_fwle;

	}else{

	    $fwle_grade = "";

	}

	// leclab or sb / final performance lecture

	$s_fple = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'final' AND area = 'performance' and exam='lecture'";
	$r_s_fple  = $conn->query($s_fple);
	if($r_s_fple->num_rows > 0){


	    while($row_fple = $r_s_fple->fetch_assoc()) {

	        $arr_fple[] = $row_fple["grade"];

	    }

	    $no_fple = count($arr_fple);

	    $sum_fple =  array_sum($arr_fple);

	    $fple_grade = $sum_fple/$no_fple;

	}else{

	    $fple_grade = "";

	}

	// leclab or sb / final major lecture

	$s_fmle = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'final' AND area = 'major' and exam='lecture'";
	$r_s_fmle  = $conn->query($s_fmle);
	if($r_s_fmle->num_rows > 0){


	    while($row_fmle = $r_s_fmle->fetch_assoc()) {

	        $arr_fmle[] = $row_fmle["grade"];

	    }

	    $no_fmle = count($arr_fmle);

	    $sum_fmle =  array_sum($arr_fmle);

	    $fmle_grade = $sum_fmle/2;

	}else{

	    $fmle_grade = "";

	}

	// leclab or sb / final written laboratory

	$s_fwla = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'final' AND area = 'written' and exam='laboratory'";
	$r_s_fwla  = $conn->query($s_fwla);
	if($r_s_fwla->num_rows > 0){


	    while($row_fwla = $r_s_fwla->fetch_assoc()) {

	        $arr_fwla[] = $row_fwla["grade"];

	    }

	    $no_fwla = count($arr_fwla);

	    $sum_fwla =  array_sum($arr_fwla);

	    $fwla_grade = $sum_fwla/$no_fwla;

	}else{

	    $fwla_grade = "";

	}

	// leclab or sb / final performance laboratory

	$s_fpla = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'final' AND area = 'performance' and exam='laboratory'";
	$r_s_fpla  = $conn->query($s_fpla);
	if($r_s_fpla->num_rows > 0){


	    while($row_fpla = $r_s_fpla->fetch_assoc()) {

	        $arr_fpla[] = $row_fpla["grade"];

	    }

	    $no_fpla = count($arr_fpla);

	    $sum_fpla =  array_sum($arr_fpla);

	    $fpla_grade = $sum_fpla/$no_fpla;

	}else{

	    $fpla_grade = "";

	}

	// leclab or sb / final major laboratory

	$s_fmla = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'final' AND area = 'major' and exam='laboratory'";
	$r_s_fmla  = $conn->query($s_fmla);
	if($r_s_fmla->num_rows > 0){


	    while($row_fmla = $r_s_fmla->fetch_assoc()) {

	        $arr_fmla[] = $row_fmla["grade"];

	    }

	    $no_fmla = count($arr_fmla);

	    $sum_fmla =  array_sum($arr_fmla);

	    $fmla_grade = $sum_fmla/2;

	}else{

	    $fmla_grade = "";

	}

}  // end if leclab or sb

else

{	
	// lec or major / midterm written

	$s_mw = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'midterm' AND area = 'written'";
	$r_s_mw  = $conn->query($s_mw);
	if($r_s_mw->num_rows > 0){


	    while($row_mw = $r_s_mw->fetch_assoc()) {

	        $arr_mw[] = $row_mw["grade"];

	    }

	    $no_mw = count($arr_mw);

	    $sum_mw =  array_sum($arr_mw);

	    $mw_grade = $sum_mw/$no_mw;

	}else{

	    $mw_grade = "";

	}

	// lec or major / midter performance
	
	$s_mp = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'midterm' AND area = 'performance'";
	$r_s_mp  = $conn->query($s_mp);
	if($r_s_mp->num_rows > 0){


	    while($row_mp = $r_s_mp->fetch_assoc()) {

	        $arr_mp[] = $row_mp["grade"];

	    }

	    $no_mp = count($arr_mp);

	    $sum_mp =  array_sum($arr_mp);

	    $mp_grade = $sum_mp/$no_mp;

	}else{

	    $mp_grade = "";

	}

	// lec or major / midter major

	$s_mm = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'midterm' AND area = 'major'";
	$r_s_mm  = $conn->query($s_mm);
	if($r_s_mm->num_rows > 0){


	    while($row_mm = $r_s_mm->fetch_assoc()) {

	        $arr_mm[] = $row_mm["grade"];

	    }

	    $no_mm = count($arr_mm);

	    $sum_mm =  array_sum($arr_mm);

	    $mm_grade = $sum_mm/2;

	}else{

	    $mm_grade = "";

	}

	// lec or major / final written

	$s_fw = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'final' AND area = 'written'";
	$r_s_fw  = $conn->query($s_fw);
	if($r_s_fw->num_rows > 0){


	    while($row_fw = $r_s_fw->fetch_assoc()) {

	        $arr_fw[] = $row_fw["grade"];

	    }

	    $no_fw = count($arr_fw);

	    $sum_fw =  array_sum($arr_fw);

	    $fw_grade = $sum_fw/$no_fw;

	}else{

	    $fw_grade = "";

	}


	// lec or major / final performance

	$s_fp = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'final' AND area = 'performance'";
	$r_s_fp  = $conn->query($s_fp);
	if($r_s_fp->num_rows > 0){


	    while($row_fp = $r_s_fp->fetch_assoc()) {

	        $arr_fp[] = $row_fp["grade"];

	    }

	    $no_fp = count($arr_fp);

	    $sum_fp =  array_sum($arr_fp);

	    $fp_grade = $sum_fp/$no_fp;

	}else{

	    $fp_grade = "";

	}

	// lec or major / final major

	$s_fm = "SELECT * FROM tb_grades WHERE student_subject_id = $student_subject_id
	                AND grade_for = 'final' AND area = 'major'";

	$r_s_fm  = $conn->query($s_fm);
	if($r_s_fm->num_rows > 0){


	    while($row_fm = $r_s_fm->fetch_assoc()) {

	        $arr_fm[] = $row_fm["grade"];

	    }

	    $no_fm = count($arr_fm);

	    $sum_fm =  array_sum($arr_fm);

	    $fm_grade = $sum_fm/2;

	}else{

	    $fm_grade = "";

	}

} // end lec or major {else} 


// get lecture and laboratory grade

if($crse_type_two == "leclab" or $crse_type_two == "sb")
{

	// midterm grade lec and lab

	// midterm lec
	$final_mlewritten_grade = ($mwle_grade * $written_per); 

	$final_mleperformance_grade = ($mple_grade * $perf_per);

	$final_mlemajor_grade = ($mmle_grade * $major_per);		
	
	$mlec_grade = $final_mlewritten_grade + $final_mleperformance_grade + $final_mlemajor_grade;

	$mlec_grade_wp = ($final_mlewritten_grade + $final_mleperformance_grade + $final_mlemajor_grade) * .40;
	// end  midterm lec

	//  midterm lab
	$final_mlawritten_grade = ($mwla_grade * $written_per);

	$final_mlaperformance_grade = ($mpla_grade * $perf_per);

	$final_mlamajor_grade = ($mmla_grade * $major_per);		

	$mlab_grade = $final_mlawritten_grade + $final_mlaperformance_grade + $final_mlamajor_grade;

	$mlab_grade_wp = ($final_mlawritten_grade + $final_mlaperformance_grade + $final_mlamajor_grade) * .60;
	// end midterm lab

	// final midterm grade lec and lab w/o  perctange
	$midterm_grade = ($mlec_grade_wp  + $mlab_grade_wp);
	// final midterm grade lec and lab w/  perctange
	$midterm_grade_wp = ($mlec_grade_wp  + $mlab_grade_wp) * $mg_per;

	// finals lec
	$final_flewritten_grade = ($fwle_grade * $written_per);

	$final_fleperformance_grade = ($fple_grade * $perf_per);

	$final_flemajor_grade = ($fmle_grade * $major_per);	
	// final lec w/o percentage
	$flec_grade = $final_flewritten_grade + $final_fleperformance_grade + $final_flemajor_grade;
	// final lec w/ percentage	
	$flec_grade_wp = ($final_flewritten_grade + $final_fleperformance_grade + $final_flemajor_grade) * .40;
	// end finals lec

	// finals lab
	$final_flawritten_grade = ($fwla_grade * $written_per);

	$final_flaperformance_grade = ($fpla_grade * $perf_per);

	$final_flamajor_grade = ($fmla_grade * $major_per);	

	$flab_grade = $final_flawritten_grade + $final_flaperformance_grade + $final_flamajor_grade;

	$flab_grade_wp = ($final_flawritten_grade + $final_flaperformance_grade + $final_flamajor_grade) * .60;
	// end finals lab 

	// final finals grade w/ percentage
	$final_grade = $flec_grade_wp  + $flab_grade_wp;

	// final finals grade w/ percentage
	$final_grade_wp = ($flec_grade_wp  + $flab_grade_wp) * .60;

	// final finals grade w/o percentage
	$finals_ave = $midterm_grade_wp + $final_grade_wp ;

}else
{
		// midterm grade
		$final_mwritten_grade = ($mw_grade * $written_per);

		$final_mperformance_grade = ($mp_grade * $perf_per);

		$final_mmajor_grade = ($mm_grade * $major_per);

		// final midterm grade lec and lab w/o  perctange
		$midterm_grade = $final_mwritten_grade + $final_mperformance_grade + $final_mmajor_grade;
		// final midterm grade lec and lab w/  perctange
		$midterm_grade_wp = ($midterm_grade) * $mg_per;

		// finals grade
		$final_fwritten_grade = ($fw_grade * $written_per);

		$final_fperformance_grade = ($fp_grade * $perf_per);

		$final_fmajor_grade = ($fm_grade *$major_per);

		// final finals grade w/ percentage
		$final_grade = $final_fwritten_grade + $final_fperformance_grade + $final_fmajor_grade;

		// final finals grade w/ percentage
		$final_grade_wp = ($final_grade) * $fg_per;

		$finals_ave = ($midterm_grade_wp) + ($final_grade_wp);

}
// end getting of lecture and laboratory grade


// convert midterm and finals grade

function convert_grade($grade = 0){

	if($grade >= 75 && $grade <= 77.4)
	{

		$converted_grade = 3;

	}elseif($grade >= 77.5 && $grade <= 80.4)
	{

		$converted_grade = 2.75;

	}elseif($grade >= 80.5 && $grade <= 83.4)
	{

		$converted_grade = 2.5;

	}elseif($grade >= 83.5 && $grade <= 86.4)
	{

		$converted_grade = 2.25;

	}elseif($grade >= 86.5 && $grade <= 89.4)
	{

		$converted_grade = 2;

	}elseif($grade >= 89.5 && $grade <= 92.4)
	{

		$converted_grade = 1.75;

	}elseif($grade >= 92.5 && $grade <= 95.4)
	{

		$converted_grade = 1.5;

	}elseif($grade >= 95.5 && $grade <= 98.4)
	{

		$converted_grade = 1.25;

	}elseif($grade >= 98.5 && $grade <= 100)
	{

		$converted_grade = 1;

	}else
	{

		$converted_grade = 0;

	}

	return $converted_grade;

}








