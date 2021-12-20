let timeoutID;


const handleInputField = () => {
  submitWithJS();
  clearTimeout(timeoutID);
  timeoutID = setTimeout(() => {
    submitWithJS();
  }, 100);
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

  const type = entries[1][1];
  //const typeCombo = entries[3][1];
  if (type === 'series') {
    resultList = resultListSeries;
  } else if (type === 'movie') {
    resultList = resultListMovie;
  } else if (type === 'movie/series') {
    resultList = resultListSeries.concat(resultListMovie);
  }

  //console.log(resultList);
  updateList(resultList);
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
  console.log(Array.isArray(list));

  for (let i = 0;i < list.length;i ++) {
    // console.log(list[i].name);
    let poster;
    let language;
    const id = list[i].id;
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
      let runtime;
      let yearItem;
      const runtimeSearch = resultApi.episode_run_time;
      if (runtimeSearch.length === 0) {
        runtime = ` <input type="hidden" name="runtime" value="2700">
                     <p class="overview__list--runtime"> 45min </p>`;
      } else {
        runtime = ` <input type="hidden" name="runtime" value="${runtimeSearch}">
                     <p class="overview__list--runtime"> ${runtimeSearch}min </p>`;
      }
      const date = list[i].first_air_date;
      const year = parseInt(date);
      if (year) {
        yearItem = year;
      } else {
        yearItem = ``;
      }

      listInner += `<li class="overview__list--item border--blue">
                     <a class="overview__list--link" href="index.php?page=detail&id=${id}&watch_type=tv&title=${list[i].name}">
                    <h2 class="overview__list--title"> ${list[i].name} <em class="overview__list--date">${yearItem}</em></h2>
                   <input type="hidden" name="watch__name" value="${list[i].name}">
                    <p class="overview__list--type"> Series </p>
                   <input type="hidden" name="watch__type" value="series">
                    ${poster}
                    ${language}
                    ${runtime}</a>
                    <input type="submit" class="button button__add" name="add" value="add to watchlist"/></li>`;
    } else if (Object.prototype.hasOwnProperty.call(list[i], 'title')) {
      const itemApi = `https://api.themoviedb.org/3/movie/${list[i].id}?api_key=662c8478635d4f25ee66abbe201e121d`;
      const apiCode = await fetch(itemApi);
      const apiJson = await apiCode.json();
      const resultApi = apiJson;
      let yearItem;
      let runtime;
      const date = list[i].release_date;
      const year = parseInt(date);
      if (year) {
        yearItem = year;
      } else {
        yearItem = ``;
      }
      const runtimeSearch = resultApi.runtime;
      if (runtimeSearch == null || runtimeSearch === 0 || runtimeSearch.length === 0) {
        runtime = ` <input type="hidden" name="runtime" value="7200">
                     <p class="overview__list--runtime"> 45min </p>`;
      } else {
        runtime = ` <input type="hidden" name="runtime" value="${runtimeSearch}">
                     <p class="overview__list--runtime"> ${runtimeSearch}min </p>`;
      }

      listInner += `<li class="overview__list--item border">
                    <a class="overview__list--link" href="index.php?page=detail&id=${id}&watch_type=TV&title=${list[i].name}">
                    <h2 class="overview__list--title"> ${list[i].title}  <em class="overview__list--date">${yearItem}</em></h2>
                   <input type="hidden" name="watch__name" value="${list[i].title}">
                      <p class="overview__list--type"> Movie </p>
                   <input type="hidden" name="watch__type" value="movies">
                    ${poster}
                    ${language}
                    ${runtime} </a>
                    <input type="submit" class="button button__add--search button__add" name="add" value="add to watchlist"/></li>`;
    }

  }

  $list.innerHTML = listInner;
};

const handleCheckPlannedItem = async e => {
  e.preventDefault();
  const url = e.currentTarget.getAttribute('action');
  const $form = e.currentTarget;
  const $li = $form.parentElement;
  $li.classList.add('passed--card');
  const data = new FormData($form);
  const obj = {};
  data.forEach((value, key) => {
    obj[key] = value;
  });
  const response = await fetch(url, {
    method: 'POST',
    headers: new Headers({
      'Content-Type': 'application/json'
    }),
    body: JSON.stringify(obj)
  });

  const returned = await response.json();
  $li.innerHTML = `
   <div class="card__title_wrapper">
   <p class="card__title"> ${(returned.title)}</p>
       <form class="removeButton" method="post" action="index.php?page=home">
          <input type="hidden" name="action" value="removeTimeslot">
          <input type="hidden" name="removedItem" value="${returned.id}">
          <input  type="submit" class="button--bin" value="">
        </form></div>
        ${returned.series === 1 ? `<p>S${returned.current_ses} Ep ${returned.current_ep}</p>` : `` }
        <p class="card__time">${returned.time.split(':')[0].padStart(2, '0')} : ${returned.time.split(':')[1].padStart(2, '0')} </p>
  `;
  // console.log(returned);
};

const handleRemovePlannedItem = async e => {
  e.preventDefault();
  const url = e.currentTarget.getAttribute('action');
  const $form = e.currentTarget;
  const $li = $form.parentElement.parentElement;
  const data = new FormData($form);
  const obj = {};
  data.forEach((value, key) => {
    obj[key] = value;
  });
  const response = await fetch(url, {
    method: 'POST',
    headers: new Headers({
      'Content-Type': 'application/json'
    }),
    body: JSON.stringify(obj)
  });
  $li.style.display = 'none';
};

export const init = async () => {
  document.documentElement.classList.add('has-js');
  document.querySelectorAll('.filter__field').forEach($field => $field.addEventListener('input', handleInputField));

  if (document.querySelector('.planner')) {document.querySelectorAll('.checkButton').forEach($form => $form.addEventListener('submit', handleCheckPlannedItem));}
  if (document.querySelector('.planner')) {document.querySelectorAll('.removeButton').forEach($form => $form.addEventListener('submit', handleRemovePlannedItem));}
};

