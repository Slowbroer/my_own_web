<?php

/* @var $this yii\web\View */

$this->title = 'Slowbro';
?>

<!--标题图片-->
<div style="height:100px;margin: 10px 0;">
    <div class='headerImg'>
        <div class='frosted-glass'>
            <!--            <img src="@web/images/header.jpg">-->
        </div>
        <h2 class="weather">
            <?php
            if(Yii::$app->user->isGuest){
                echo "<a href='index.php?r=site/login'>Slowbro</a>";
            }
            else{
                echo Yii::$app->user->identity->username;
            }
            ?>

        </h2>
        <!--        <img class='weather' src='cloudy.png'>-->
    </div>
</div>

<style>
    mark {
        background-color: #FFFF00;
        border: 1px dashed #FFFF00;
    }
    .instruction {
        -webkit-transform: rotate(90deg) translateX(-50%);
        transform: rotate(90deg) translateX(-50%);
        -webkit-transform-origin: left top 0;
        transform-origin: left top 0;
        -webkit-transform-origin: 0 0;
        transform-origin: 0 0;
        position: absolute;
        left: 2.05em;
        text-align: center;
        letter-spacing: 1px;
        word-spacing: 1px;
        margin: 0;
        top: 50%;
        color: rgba(0, 0, 0, 0.7);
        background-color: rgba(255, 255, 255, 0.5);
        width: 200vw;
        padding: 1em;
        line-height: 0;
        display: inline-block;
    }
    .agian-button {
        border: none;
        background-color: rgba(80, 11, 6, 0.4);
        color: white;
        padding: 1.25em 2em;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        position: fixed;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    .all {
        width: 21em;
        position: relative;
        top: 2em;
        margin: 0 auto;
        max-width: calc(100vw - 6em);
    }

    section article {
        overflow: auto;
        margin: 0;
        opacity: 0;
        -webkit-transition: 1s opacity;
        transition: 1s opacity;
    }

    h1 {
        margin-top: 0;
    }

    section {
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        position: absolute;
        top: 0;
        height: 20em;
        max-height: calc(100vh - 10em);
        background-color: white;
        border: 1px solid black;
        padding: 3.5em 1.5em 1.5em 2.5em;
        overflow: auto;
        -webkit-transition: 1.5s opacity, 1.5s -webkit-transform;
        transition: 1.5s opacity, 1.5s -webkit-transform;
        transition: 1.5s transform, 1.5s opacity;
        transition: 1.5s transform, 1.5s opacity, 1.5s -webkit-transform;
        background-color: #fafafa;
    }
    section:before {
        display: block;
        font-size: 0.65em;
        min-width: 1em;
        text-align: center;
        position: absolute;
        top: 2em;
        right: 1.5em;
        background-color: rgba(80, 11, 6, 0.4);
        color: white;
        padding: 0.3em;
    }

    p:first-of-type {
        margin-top: 0;
    }

    section:nth-child(1) {
        z-index: 10;
        -webkit-transform: rotate(-4deg);
        transform: rotate(-4deg);
    }
    section:nth-child(1):before {
        content: "1";
    }
    section:nth-child(1).leave {
        -webkit-transform: rotate(-4deg) translateY(50em) scale3d(0.6, 0.6, 1);
        transform: rotate(-4deg) translateY(50em) scale3d(0.6, 0.6, 1);
        opacity: 0.3;
    }
    section.active {
        -webkit-transform: rotate(0);
        transform: rotate(0);
        background-color: #fff;
    }
    section.active article {
        opacity: 1;
    }

    section:nth-child(2) {
        z-index: 9;
        -webkit-transform: rotate(-4deg);
        transform: rotate(-4deg);
    }
    section:nth-child(2):before {
        content: "2";
    }
    section:nth-child(2).leave {
        -webkit-transform: rotate(-4deg) translateY(50em) scale3d(0.6, 0.6, 1);
        transform: rotate(-4deg) translateY(50em) scale3d(0.6, 0.6, 1);
        opacity: 0.3;
    }
    section.active {
        -webkit-transform: rotate(0);
        transform: rotate(0);
        background-color: #fff;
    }
    section.active article {
        opacity: 1;
    }

    section:nth-child(3) {
        z-index: 8;
        -webkit-transform: rotate(3deg);
        transform: rotate(3deg);
    }
    section:nth-child(3):before {
        content: "3";
    }
    section:nth-child(3).leave {
        -webkit-transform: rotate(3deg) translateY(50em) scale3d(0.6, 0.6, 1);
        transform: rotate(3deg) translateY(50em) scale3d(0.6, 0.6, 1);
        opacity: 0.3;
    }
    section.active {
        -webkit-transform: rotate(0);
        transform: rotate(0);
        background-color: #fff;
    }
    section.active article {
        opacity: 1;
    }

    section:nth-child(4) {
        z-index: 7;
        -webkit-transform: rotate(-3deg);
        transform: rotate(-3deg);
    }
    section:nth-child(4):before {
        content: "4";
    }
    section:nth-child(4).leave {
        -webkit-transform: rotate(-3deg) translateY(50em) scale3d(0.6, 0.6, 1);
        transform: rotate(-3deg) translateY(50em) scale3d(0.6, 0.6, 1);
        opacity: 0.3;
    }
    section.active {
        -webkit-transform: rotate(0);
        transform: rotate(0);
        background-color: #fff;
    }
    section.active article {
        opacity: 1;
    }

    section:nth-child(5) {
        z-index: 6;
        -webkit-transform: rotate(2deg);
        transform: rotate(2deg);
    }
    section:nth-child(5):before {
        content: "5";
    }
    section:nth-child(5).leave {
        -webkit-transform: rotate(2deg) translateY(50em) scale3d(0.6, 0.6, 1);
        transform: rotate(2deg) translateY(50em) scale3d(0.6, 0.6, 1);
        opacity: 0.3;
    }
    section.active {
        -webkit-transform: rotate(0);
        transform: rotate(0);
        background-color: #fff;
    }
    section.active article {
        opacity: 1;
    }

    section:nth-child(6) {
        z-index: 5;
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    section:nth-child(6):before {
        content: "6";
    }
    section:nth-child(6).leave {
        -webkit-transform: rotate(0deg) translateY(50em) scale3d(0.6, 0.6, 1);
        transform: rotate(0deg) translateY(50em) scale3d(0.6, 0.6, 1);
        opacity: 0.3;
    }
    section.active {
        -webkit-transform: rotate(0);
        transform: rotate(0);
        background-color: #fff;
    }
    section.active article {
        opacity: 1;
    }

    section:nth-child(7) {
        z-index: 4;
        -webkit-transform: rotate(-2deg);
        transform: rotate(-2deg);
    }
    section:nth-child(7):before {
        content: "7";
    }
    section:nth-child(7).leave {
        -webkit-transform: rotate(-2deg) translateY(50em) scale3d(0.6, 0.6, 1);
        transform: rotate(-2deg) translateY(50em) scale3d(0.6, 0.6, 1);
        opacity: 0.3;
    }
    section.active {
        -webkit-transform: rotate(0);
        transform: rotate(0);
        background-color: #fff;
    }
    section.active article {
        opacity: 1;
    }

    section:nth-child(8) {
        z-index: 3;
        -webkit-transform: rotate(-2deg);
        transform: rotate(-2deg);
    }
    section:nth-child(8):before {
        content: "8";
    }
    section:nth-child(8).leave {
        -webkit-transform: rotate(-2deg) translateY(50em) scale3d(0.6, 0.6, 1);
        transform: rotate(-2deg) translateY(50em) scale3d(0.6, 0.6, 1);
        opacity: 0.3;
    }
    section.active {
        -webkit-transform: rotate(0);
        transform: rotate(0);
        background-color: #fff;
    }
    section.active article {
        opacity: 1;
    }

    section:nth-child(9) {
        z-index: 2;
        -webkit-transform: rotate(-4deg);
        transform: rotate(-4deg);
    }
    section:nth-child(9):before {
        content: "9";
    }
    section:nth-child(9).leave {
        -webkit-transform: rotate(-4deg) translateY(50em) scale3d(0.6, 0.6, 1);
        transform: rotate(-4deg) translateY(50em) scale3d(0.6, 0.6, 1);
        opacity: 0.3;
    }
    section.active {
        -webkit-transform: rotate(0);
        transform: rotate(0);
        background-color: #fff;
    }
    section.active article {
        opacity: 1;
    }

    section:nth-child(10) {
        z-index: 1;
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    section:nth-child(10):before {
        content: "10";
    }
    section:nth-child(10).leave {
        -webkit-transform: rotate(0deg) translateY(50em) scale3d(0.6, 0.6, 1);
        transform: rotate(0deg) translateY(50em) scale3d(0.6, 0.6, 1);
        opacity: 0.3;
    }
    section.active {
        -webkit-transform: rotate(0);
        transform: rotate(0);
        background-color: #fff;
    }
    section.active article {
        opacity: 1;
    }
</style>

<!--<p class="instruction">Click a page to advance</p>-->
<div class="all">
    <section class="active">
        <article>
            <h1>Chapter 1</h1>
            <p>I was a smart child, but for a pointless reason. The entire effort was to impress my Dad. He took notice of me only when I was in his way. Class president, good athelete, math wiz. Fuck it. He didn't give a shit about any of it.</p>
            <p>The story goes that he became very weak in his early 30s. He would ask the neighbors to help him carry bags of groceries into the house. Just before my 2<sup>nd</sup> birthday, he was diagnosed with <abbr title="multiple sclerosis">MS</abbr>.</p>
        </article>
    </section>
    <section>
        <article>
            <p>He was some sort of card player savant and could hold 3 decks of cards in his memory. This was a fortuitous skill to have considering his lack of mobility. He taught a weekly bridge class and was revered by his students.</p>
            <p>They all made sure to remind me of his greatness.</p>
            <p>
                <q>You're a lucky boy to have a father like that.</q>
            </p>
            <p>
                <q>Please tell your father I love him. What a wonderful man.</q>
            </p>
            <p>It didn't make sense to me. At home, he would ensure my mother and I suffered along with him. He berated her for various infractions. Once, the vegatables were too cold. He wiped them off the table with his still powerful arm and ordered her to make it again. Another time, when I was still a baby, my mother requested he stay home to take care of me. It was almost midnight. He screamed at her and rammed his shoulder into a bookcase, sending it crashing inches from my crib.</p>
            <p>He was a stranger at home.</p>
        </article>
    </section>
    <section>
        <article>
            <p>17 years into their marriage, my mother—with the help of a therapist—facilitated a divorce. He had been having an affair with one of his adoring bridge students for years and this woman agreed to care for him (a task which was considerable at that point).</p>
            <p>Soon after he left our home, I immediatley ceased caring about all forms of achievement. My teachers were baffled. It was a true 180 degree pivot.</p>
            <p>And then the anger came. It was like some classic horror film come to life. Just as he was supposedly vanquished, my father, like some crafty spector, transferred his darkness into my body. It felt like a sourness, a kind of permanent dissatisfaction. I was 10.</p>
            <p>My grades plummeted. I withdrew from all activities and developed a fear of other children. I began using food as a drug.</p>
            <p>Thousands of calories quenched the pain. I would creep downstairs after the house was asleep, avoiding the memorized creaks in the stairs. The refrigerator provided all I'd need to escape for the night.</p>
        </article>
    </section>
    <section>
        <article>
            <p>With my dad gone and our time together reduced to perfunctory monthly meetings where he watched me eat a hamburger for an hour, I had a lot of time to think. Too much time. The kids at school began to pick on me because I had gotten heavy. The solution was not to run away, but instead to dismantle them using words.</p>
            <p>Nobody wants to be laughed at for how they talk. I would insult bullies in this way, using words they did not know, mocking their thin education. Very soon the bullying stopped. One girl prank called my house with some friends. I had her crying inside of 3 minutes.</p>
            <p>I became a cruel person, anxious and predatory. Words offered me protection like the maffia protecting a business for an impossibly steep price.</p>
        </article>
    </section>
    <section>
        <article>
            <p>As highschool approached, I stopped attending. It felt as if the entire population of students knew my daily hell routine and I could no longer face their inquisitive glances. They needed to know why I was not like them and I had no answers.</p>
            <p>One teacher called me at home and tricked me into coming in to school. He claimed he just wanted to talk.
                <q>About what?</q> I responded. My mom drove me to the gray building with the trimmed lawn and I walked into something of an intervention. Several of the school therapists were waiting with clipboards and the football coach, an enormous, asthmatic man named Joe Gro informed me I was going to the clinic for troubled teens.
            </p>
            <p>An adventure!</p>
        </article>
    </section>
</div>
<button class="agian-button">Again</button>
<script>
    var sections = document.querySelectorAll('section');

    function getNextSlideIndex() {
        var next_slide_index;

        Array.prototype.forEach.call(sections, function(section, index) {
            if (section.classList.contains('active')) {
                next_slide_index = (index + 1);
            }
        });

        return next_slide_index < sections.length ? next_slide_index : -1;
    }

    function sectionsHandler(section, index) {
        section.addEventListener('click', sectionClickHandler);
    }

    function sectionClickHandler() {
        var next_slide_index = getNextSlideIndex.call(this);

        if (this.classList.contains('active')) {
            if (next_slide_index > -1) {
                sections[next_slide_index].classList.add('active');
            }

            this.classList.add('leave');
            this.classList.remove('active');
        }
    }

    function resetHandler() {
        for (var i = sections.length - 1; i >= 0; i--) {
            (function(index) {
                sections[index].classList.remove('leave');
                sections[index].scrollTop = 0;
            }(i));
        }
        sections[0].classList.add('active');
    }

    Array.prototype.forEach.call(sections, sectionsHandler);
    $(".agian-button").on("click",resetHandler);

//    document.querySelector('button').addEventListener('click', resetHandler);
</script>
