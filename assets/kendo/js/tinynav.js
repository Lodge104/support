function tinyNav(element, options) {
  var i = 0;

  // Default settings
  var settings = Object.assign({
    active: 'selected',
    header: '',
    indent: '- ',
  }, options);

  // Used for namespacing
  i++;

  var navElement = document.querySelector(element);
  if (!navElement) return;

  // Namespacing
  var namespace = 'tinynav';
  var namespace_i = namespace + i;
  var l_namespace_i = '.l_' + namespace_i;

  var selectElement = document.createElement('select');
  selectElement.id = namespace_i;
  selectElement.classList.add(namespace, namespace_i);

  if (navElement.tagName === 'UL' || navElement.tagName === 'OL') {
    if (settings.header !== '') {
      var headerOption = document.createElement('option');
      headerOption.textContent = settings.header;
      selectElement.appendChild(headerOption);
    }

    var optionsHTML = '';

    var links = navElement.querySelectorAll('a');
    links.forEach(function (link) {
      var optionValue = link.getAttribute('href');
      var optionText = link.textContent;

      var indentation = '';
      var parentNode = link.parentNode;
      while (parentNode && parentNode !== navElement) {
        indentation += settings.indent;
        parentNode = parentNode.parentNode;
      }

      optionsHTML += '<option value="' + optionValue + '">' + indentation + optionText + '</option>';
    });

    selectElement.innerHTML += optionsHTML;

    if (!settings.header) {
      var activeIndex = Array.from(navElement.querySelectorAll(l_namespace_i + ' li.' + settings.active)).indexOf(navElement.querySelector(l_namespace_i + ' li.' + settings.active));
      selectElement.options[activeIndex + (settings.header !== '' ? 1 : 0)].selected = true;
    }

    selectElement.addEventListener('change', function () {
      window.location.href = selectElement.value;
    });

    navElement.classList.add('l_' + namespace_i);
    navElement.parentNode.insertBefore(selectElement, navElement.nextSibling);

  }
}

