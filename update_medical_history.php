<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'conn/conn.php'; // Database connection

    // $med_id = $_POST['med_id'];
    // $med_date = $_POST['med_date'];
    // $med_prev_dent = $_POST['med_prev_dent'];
    // $med_last_vi = $_POST['med_last_vi'];
    // $one = $_POST['one'];
    // $two = $_POST['two'];
    // $two_answer = $_POST['two_answer'];
    // $three = $_POST['three'];
    // $three_answer = $_POST['three_answer'];
    // $four = $_POST['four'];
    // $four_answer = $_POST['four_answer'];
    // $five = $_POST['five'];
    // $five_answer = $_POST['five_answer'];
    // $six = $_POST['six'];
    // $seven = $_POST['seven'];
    // $allergies_str = $_POST['allergies_str'];
    // $pregnant = $_POST['pregnant'];
    // $nursing = $_POST['nursing'];
    // $pills = $_POST['pills'];
    // $blood_type = $_POST['blood_type'];
    // $conditions_str = $_POST['conditions_str'];
           // Collect form data
    $one = $_POST['one'];
    $two = $_POST['two'];
    $two_answer = $_POST['two_answer'];
    $three = $_POST['three'];
    $three_answer = $_POST['three_answer'];
    $four = $_POST['four'];
    $four_answer = $_POST['four_answer'];
    $five = $_POST['five'];
    $five_answer = $_POST['five_answer'];
    $six = $_POST['six'];
    $seven = $_POST['seven'];
    
    // Process allergies
    $local_anesthetic = isset($_POST['local_anesthetic']) ? 'Local Anesthetic' : '';
    $penicilin = isset($_POST['penicilin']) ? 'Penicilin, Antibiotics' : '';
    $aspinn = isset($_POST['aspinn']) ? 'Aspinn' : '';
    $latex = isset($_POST['latex']) ? 'Latex' : '';
    $sulfa_drugs = isset($_POST['sulfa_drugs']) ? 'Sulfa drugs' : '';
    $others = isset($_POST['others']) ? 'Others' : '';
    $others_answer = $_POST['others_answer'];

    // Combine allergies into a string
    $allergies = [];
    if ($local_anesthetic) $allergies[] = $local_anesthetic;
    if ($penicilin) $allergies[] = $penicilin;
    if ($aspinn) $allergies[] = $aspinn;
    if ($latex) $allergies[] = $latex;
    if ($sulfa_drugs) $allergies[] = $sulfa_drugs;
    if ($others) $allergies[] = $others . ': ' . $others_answer;
    $allergies_str = implode(', ', $allergies);
    
    // Process conditions
    $conditions = [];
    if (isset($_POST['high_blood'])) $conditions[] = 'High Blood Pressure';
    if (isset($_POST['hepatitis'])) $conditions[] = 'Hepatitis/Jaundice';
    if (isset($_POST['low_blood'])) $conditions[] = 'Low Blood Pressure';
    if (isset($_POST['tuberculosis'])) $conditions[] = 'Tuberculosis';
    if (isset($_POST['epilepsy'])) $conditions[] = 'Epilepsy/Convulsions';
    if (isset($_POST['swolen'])) $conditions[] = 'Swolen ankles/Kidney disease';
    if (isset($_POST['aids'])) $conditions[] = 'AIDS or HIV Infection';
    if (isset($_POST['asthma'])) $conditions[] = 'Asthma';
    if (isset($_POST['sexually'])) $conditions[] = 'Sexually Transmitted disease';
    if (isset($_POST['emphysema'])) $conditions[] = 'Emphysema';
    if (isset($_POST['ulcer'])) $conditions[] = 'Stomach Troubles/Ulcers';
    if (isset($_POST['bleeding_problem'])) $conditions[] = 'Bleeding Problems';
    if (isset($_POST['fainting_sozure'])) $conditions[] = 'Fainting Seizure';
    if (isset($_POST['blood_diseases'])) $conditions[] = 'Blood Diseases';
    if (isset($_POST['rapid_weight'])) $conditions[] = 'Rapid Weight Loss';
    if (isset($_POST['head_injuries'])) $conditions[] = 'Head Injuries';
    if (isset($_POST['radiation_therapy'])) $conditions[] = 'Radiation Therapy';
    if (isset($_POST['angina_arthritis'])) $conditions[] = 'Angina/Arthritis/Rheumatism';
    if (isset($_POST['joint_replacement'])) $conditions[] = 'Joint Replacement/Implant';
    if (isset($_POST['heart_surgery'])) $conditions[] = 'Heart Surgery';
    if (isset($_POST['heart_attack'])) $conditions[] = 'Heart Attack';
    if (isset($_POST['heart_disease'])) $conditions[] = 'Heart Disease';
    if (isset($_POST['thyroid'])) $conditions[] = 'Thyroid Problem';
    if (isset($_POST['heart_murmur'])) $conditions[] = 'Heart Murmur';
    if (isset($_POST['liver_disease'])) $conditions[] = 'Hepatitis/Liver Disease';
    if (isset($_POST['rheumatic_faver'])) $conditions[] = 'Rheumatic Fever';
    if (isset($_POST['hay_faver'])) $conditions[] = 'Hay Fever/Allergies';
    if (isset($_POST['respvalory'])) $conditions[] = 'Respiratory Problems';
    if (isset($_POST['daboles'])) $conditions[] = 'Diabetes';
    if (isset($_POST['chul_pain'])) $conditions[] = 'Chest Pain/Stroke';
    if (isset($_POST['cancer'])) $conditions[] = 'Cancer/Tumors';
    if (isset($_POST['anomia'])) $conditions[] = 'Anemia';
    if (isset($_POST['others_two'])) $conditions[] = 'Others: ' . $_POST['others_two_answer'];
    $conditions_str = implode(', ', $conditions);

    // Other form data
    $date = date('F d,Y H:i: A',time());
    $u_id = $_POST['u_id'];
    $prev_dentist = $_POST['prev_dentist'];
    $last_visit= $_POST['last_visit'];
    $med_id = $_POST['med_id']; // Get med_id for the update query

    // Update data in the database
    $sql_update = "UPDATE medical_history 
                   SET 
                   med_date = '$date',
                   med_prev_dent = '$prev_dentist',
                   med_last_vi = '$last_visit',
                   one = '$one',
                   two = '$two',
                   two_answer = '$two_answer',
                   three = '$three',
                   three_answer = '$three_answer',
                   four = '$four',
                   four_answer = '$four_answer',
                   five = '$five',
                   five_answer = '$five_answer',
                   six = '$six',
                   seven = '$seven',
                   allergies_str = '$allergies_str',
                   pregnant = '".$_POST['pregnant']."',
                   nursing = '".$_POST['nursing']."',
                   pills = '".$_POST['pills']."',
                   blood_type = '".$_POST['blood_type']."',
                   conditions_str = '$conditions_str',
                   u_id = '$u_id'
                   WHERE med_id = '$med_id'";

                 
}
?>
