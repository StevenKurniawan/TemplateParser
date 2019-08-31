# TemplateParser
A library to parse data into a single view file (main page) as a main view in CodeIgniter

## Getting Started

Put the Template_Parser.php to the library folder

### Prerequisites

Download CodeIgniter at https://www.codeigniter.com/download

Put the extracted downloaded file to htdocs folder

### Installing

Put the Template_Parser.php to library folder and edit autoload file to:

```
$autoload['libraries'] = array('template_parser');
```

Create main view with brackets variable to change the value, eg:
*The default path to the main view file is views/page/page.

```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{base_url}">
    <title>{title}</title>
</head>
<body>
    {main}
    <div style="background-color: yellow;">asdasd</div>
    {footer}
</body>
</html>
```

Don't forget to inclue the base tag in the head tag so your assets could be loaded correctly.
*it's important to set the base before loading another assets in the head tag and set the base_url path in the config.

```
<base href="{base_url}">
```

To use the library in controller

```
$config = [
			'title' => 'Title',
			'main' => $this->load->view("main", null, true),
		];
		$this->template_parser->load($config);
```

To custom the main view path, add the path to your view

```
$this->template_parser->load($config, your/path);
```

To see the example app, put the exampleApp folder to your htdocs folder and run with your localhost_url/exampleapp

## Authors

* **Steven Kurniawan** - *Initial work*

