$(function () {
    var selectedMode = 0,
            questionEditor = ace.edit('questionEditor'),
            inputEditor = ace.edit('inputEditor'),
            codeEditor = ace.edit('codeEditor');

    //--- set theme---//
    questionEditor.setTheme('ace/theme/monokai');
    inputEditor.setTheme('ace/theme/monokai');
    codeEditor.setTheme('ace/theme/monokai');

    //--- set modes ---//
    inputEditor.session.setMode('ace/mode/text');
    codeEditor.session.setMode('ace/mode/' + scriptingModes[0].aceMode);

    //--- set value ---//
    questionEditor.session.setValue(questionValue);
    codeEditor.session.setValue(scriptingModes[0].value);

    //--- allow modes selection ---//
    $.each(scriptingModes, function (id, element) {
        $('#' + element.mode).click(function () {
                scriptingModes[selectedMode].value = codeEditor.session.getValue();
                codeEditor.session.setMode('ace/mode/' + element.aceMode);
                selectedMode = id;
                codeEditor.session.setValue(element.value);
        });
    });
    //--- shortcut ---//
    addCommandToEditor(questionEditor);
    addCommandToEditor(inputEditor);
    addCommandToEditor(codeEditor);

    //--- generate one input example ---//
    inputEditor.on('change', function () {
        $.ajax({
            type: 'POST',
            url: '../ajax/exampleInput.php',
            data: {
                inputFormat: inputEditor.getValue()
            },
            timeout: 3000,
            success: function (data) {
                data = JSON.parse(data);
                if (data['success'] && data['message']) {
                    $('#inputExample .content').html('');
                    data['message'] = data['message'].split('|');
                    $.each(data['message'], function (id, element) {
                        $('#inputExample .content').append(element + '<br/>');
                    });
                } else {

                }
            },
            beforeSend: function () {
                $('#inputExample .content').hide();
                $('#inputExample .loader').show();
            },
            complete: function () {
                $('#inputExample .content').show();
                $('#inputExample .loader').hide();
            }
        });
    });

    $('#register').click(function () {
        $.ajax({
            type: 'POST',
            url: '../ajax/creation.php',
            data: {
                question: questionEditor.getValue(),
                inputFormat: inputEditor.getValue(),
                numberOfInputToGenerate: 20,
                userCode: codeEditor.getValue(),
                langage: scriptingModes[selectedMode].mode
            },
            success: function (data) {
                data = JSON.parse(data);
                $('.warning').css('visibility', 'hidden');
                $('#message').html('');
                if(data['success'] == -1){
                    let w = $('.warning:eq(0)');
                    w.css('visibility', 'visible');
                    w.attr('data-tooltip', data['message']);
                    w.tooltip();
                } else if(data['success'] == -2){
                    let w = $('.warning:eq(1)');
                    w.css('visibility', 'visible');
                    w.attr('data-tooltip', data['message']);
                    w.tooltip();
                } else if(data['success'] == -3){
                    let w = $('.warning:eq(2)');
                    w.css('visibility', 'visible');
                    w.attr('data-tooltip', data['message']);
                    w.tooltip();
                } else if(data['success'] == -4){
                    $('#message').html(data['message']);
                } else if(data['success'] == 1){
                    $('#message').html(data['message']);
                }
            },
            beforeSend: function () {
                $('#register').css('visibility', 'hidden');
            },
            complete: function () {
                $('#register').css('visibility', 'visible');
            }
        });
    });

});


/*
 * Enunciated
Lors de votre promenade au salon de l’agriculture, vous tombez sur l’évènement phare : le concours de la race limousine. Vous ne connaissez pas exactement quels sont les critères de sélection utilisés par le jury mais vous décidez d’inventer les vôtres.

Pour prétendre au titre, les taureaux doivent absolument :- Être âgés entre 2 et 5 ans
- Peser entre 1250Kg et 1500Kg
Pour les départager, vous leur attribuez :
- Une note sur 20 basée sur leur démarche
- Une note sur 20 basée sur la courbure de leur dos
Celui qui répond aux critères et obtient la meilleure moyenne de notes gagne votre concours.

Input
Ligne 1 à N+1 : une chaîne S comprenant 7 lettres majuscules et 4 entiers A, B, C et D séparés par un espace où S correspond à l’identifiant d’un prétendant, A à son âge en année, B à son poids en kilogramme, C à la note sur 20 de sa démarche et D à la note sur 20 de sa courbure.

Output
Une chaîne de caractères correspondant à l’identifiant du gagnant du concours. S'il y a plusieurs gagnants ex-aequos, affichez les tous séparés par un espace.

 * 
 * 
 * 
 * A->Z*6/2->5/1250->1500/0->20*2~10->45;
 * 
 * 
 * 
 * 
 * <?php
$list_score = [];
do{
	$f = stream_get_line(STDIN, 10000, PHP_EOL);
	if($f!==false){
		list($id, $age, $poids, $demarche, $courbure) = explode(' ', $f);
        if($age >=2 && $age <= 5 && $poids >= 1250 && $poids <= 1500){
            $list_score[$id] = ($demarche + $courbure)/2 ;
        }
        $max_scores = array_keys($list_score, max($list_score));
	}
}while($f!==false);
echo implode(' ', $max_scores);
 */