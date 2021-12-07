let timeoutID;


const handleInputField = () => {
  submitWithJS();
  clearTimeout(timeoutID);
  timeoutID = setTimeout(() => {
    submitWithJS();
  }, 1000);
};

const submitWithJS = async () => {
  const $form = document.querySelector('.filter-form');
  const data = new FormData($form);
  const entries = [...data.entries()];
  const qs = entries[2][1];
  const urlSeries = `https://api.themoviedb.org/3/search/tv?api_key=662c8478635d4f25ee66abbe201e121d&query=${qs}`;
  const urlMovies = `https://api.themoviedb.org/3/search/movie?api_key=662c8478635d4f25ee66abbe201e121d&query=${qs}`;
  const responseSeries = await fetch(urlSeries);
  const listSeries = await responseSeries.json();
  const resultListSeries = listSeries.results;
  const responseMovie = await fetch(urlMovies);
  const listMovie = await responseMovie.json();
  const resultListMovie = listMovie.results;
  let resultList;

  console.log(entries);

  console.log(entries[1][1]);
  const type = entries[1][1];
  console.log(type);
  //const typeCombo = entries[3][1];
  if (type === 'series') {
    resultList = resultListSeries;
    updateList(resultList);

  } else if (type === 'movie') {
    resultList = resultListMovie;
    updateList(resultList);

  } else if (type === 'movie/series') {
    resultList = resultListSeries.concat(resultListMovie);
    updateList(resultList);
  }
};


const updateList = async list => {
  const $list = document.querySelector('.overview__list');
  $list.innerHTML = ' ';
  let listInner = ' ';
  const $form = document.querySelector('.filter-form');
  const data = new FormData($form);
  const entries = [...data.entries()];
  const qs = entries[1][1];

  console.log('querystring', qs);


  const languageNames = new Intl.DisplayNames(['en'], {type: 'language'});

  for (let i = 0;i < list.length;i ++) {
    // console.log(list[i].name);

    let poster;
    let language;
    const languageSearch = list[i].original_language;
    const languageFull = languageNames.of(languageSearch);
    if (list[i].poster_path) {
      poster = `<img class="overview__list--img" src="https://image.tmdb.org/t/p/w500/${list[i].poster_path}" alt="">`;
    } else {
      poster = `<p class="overview__list--img img__notfound dropshadow" > W </p>`;
    }

    if (list[i].original_language) {
      language = `<p class="overview__list--language">${languageFull}</p>`;
    } else {
      language = ``;
    }

    if (Object.prototype.hasOwnProperty.call(list[i], 'name')) {
      const itemApi = `https://api.themoviedb.org/3/tv/${list[i].id}?api_key=662c8478635d4f25ee66abbe201e121d`;
      const apiCode = await fetch(itemApi);
      const apiJson = await apiCode.json();
      const resultApi = apiJson;
      const runtime = resultApi.episode_run_time;
      const date = list[i].first_air_date;
      const year = parseInt(date);

      listInner += `<li class="overview__list--item border--blue">
                    <h2 class="overview__list--title"> ${list[i].name}</h2>
                   <input type="hidden" name="watch__name" value="${list[i].name}">
                    <p class="overview__list--date">(${year})</p>
                    ${poster}
                    ${language}
                    <input type="hidden" name="runtime" value="${runtime}">
                    <p class="overview__list--runtime"> ${runtime}min </p></li>`;
    } else if (Object.prototype.hasOwnProperty.call(list[i], 'title')) {
      const itemApi = `https://api.themoviedb.org/3/movie/${list[i].id}?api_key=662c8478635d4f25ee66abbe201e121d`;
      const apiCode = await fetch(itemApi);
      const apiJson = await apiCode.json();
      const resultApi = apiJson;
      const runtime = resultApi.runtime;

      const date = list[i].release_date;
      const year = parseInt(date);


      listInner += `<li class="overview__list--item border">
                    <h2 class="overview__list--title"> ${list[i].title}</h2>
                   <input type="hidden" name="watch__name" value="${list[i].title}">
                    <p class="overview__list--date">(${year})</p>
                    ${poster}
                    ${language}
                    <input type="hidden" name="runtime" value="${runtime}">
                    <p class="overview__list--runtime"> ${runtime}min </p> </li>`;
    }

  }
  $list.innerHTML += listInner;

};


// foreach($exists as $existing){
//           if($item->id == $existing->watch_id){
//             $idExists= $item->id;
//           }
//         }
//           if(!isset($idExists) || $idExists != $item->id){
//               echo '<input type="submit" class="button" name="add" value="add to watchlist"/>';
//           } else if($idExists = $item->id) {
//             echo '<p class="button">Added to watchlist</p>';
//           }


export const init = async () => {
  document.documentElement.classList.add('has-js');
  document.querySelectorAll('.filter__field').forEach($field => $field.addEventListener('input', handleInputField));

};

