## Project Definition and Goals

In the realm of application hosting, uptime monitoring has always been the traditional approach to safeguard websites and e-commerce stores. While this is indeed efficient and straightforward, the increasing complexity of modern applications makes this method inadequate in professional settings.

To address this flaw in modern application operation, our focus extends beyond mere uptime monitoring to encompass the true vital aspects of an online application, such as updates, user management, shop orders, and other crucial health metrics. The lack of functionality in parts of an application can often go unnoticed with standard monitoring practices.

The project aims to collect, analyze, and provide additional data from websites with a better understanding of their health to the respective operator. The website operator or hosting company is often expected to keep the overview, but the absence of a standardized format for health checks across the manifold CMS landscape makes this a hard challenge to solve.

Based on this idea, a first Proof of Concept was created at CloudFest Hackathon 2024 with the goal to jointly develop a health check format that works for open-source systems like Drupal, TYPO3, Joomla!, WordPress, and frameworks. The initial phase involves the ideation and development of a standardized format for the CMS health checks, that accommodates the unique requirements of different open-source systems and offers flexibility and extensibility. Additionally, we’re aiming to have the first basic implementation for the participating CMS systems in place that can report basic health data in a secure and privacy-friendly way.

## Format

The interface is based on HTTP communication with responses in JSON format. The format is based on the IETF draft "Health Check Response Format for HTTP APIs" (https://datatracker.ietf.org/doc/html/draft-inadarei-api-health-check-06). Please see the following example and explanation:

```json
{
  "status": "pass",
  "version": "1",
  "serviceId": "example.org",
  "description": "Health of WordPress website example.org",
  "checks": {
	"WordPress:Version": [
	  {
		"componentId": "identifier1",
		"componentType": "system",
		"observedValue": "6.4.3",
		"status": "pass",
		"time": "2018-01-17T03:36:48Z",
		"output": ""
	  }
	],
	"WordPress:DirectorySize": [
	  {
		"componentId": "identifier2",
		"componentType": "system",
		"observedValue": "25",
		"observedUnit": "GB",
		"status": "warn",
		"time": "2018-01-17T03:36:48Z",
		"output": "Directory size of installation exceeds defined threshold"
	  }
	],
	"WordPress:FailedLogins": [
	  {
		"componentId": "identifier3",
		"componentType": "system",
		"observedValue": "20",
		"status": "warn",
		"time": "2018-01-17T03:36:48Z",
		"output": "Number of failed login attempts in the last 24 hours exceeded defined threshold"
	  }
	],
	"WordPress:OutdatedPlugins": [
	  {
		"componentId": "identifier4",
		"componentType": "system",		
		"observedValue": "5",
		"status": "fail",
		"time": "2018-01-17T03:36:48Z",
		"output": "Some plugins are outdated and need to be updated"
	  }
	],
	"WordPress:UserMFAActivated": [
	  {
		"componentId": "identifier5.1",
		"componentType": "system",
		"observedValue": "username1",
		"status": "pass",
		"time": "2018-01-17T03:36:48Z",
		"output": ""
	  },
	  {
		"componentId": "identifier5.2",
		"componentType": "system",
		"observedValue": "username2",
		"status": "fail",
		"time": "2018-01-17T03:36:48Z",
		"output": "User username2 has not activated MFA"
	  }
	],
	"Yoast:Check1": [
	  {
		"componentId": "identifier6",
		"componentType": "component",
		"status": "pass",
		"time": "2018-01-17T03:36:48Z",
		"output": ""
	  }
	],
	"SecurityPlugin:FilePermissions": [
	  {
		"componentId": "identifier7",
		"componentType": "component",
		"status": "fail",
		"time": "2018-01-17T03:36:48Z",
		"output": "File permissions are not correctly set"
	  }
	],
	"WordPress:LastUserLoginTime": [
	  {
		"componentId": "identifier8",
		"componentType": "system",
		"status": "info",
		"time": "2018-01-17T03:36:48Z",
		"output": "2018-01-17T03:36:48Z"
	  }
	]
  }
}
```

### Field explanation

#### status
*(required)* The overall status of all checks. It has a value of "pass", "fail" or "warn".

The status should be set to:
* "pass" if the CMS is fully operational and all checks also pass,
* "fail" if the CMS is not working or one or more checks fail,
* "warn" if the CMS has issues the admin should care about, but is still operational or one or more checks warn and no checks fail. 

#### version
*(optional)* public version of the health check API.

#### serviceId
*(optional)* a unique identifier of the service, in this case the URL of the website responsing.

#### description
*(optional)* a human-friendly description of the service.

#### checks
*(required)* The checks object containing all single check data. "checks" contains one or more check results as an array.

##### name
*(required)* The name of the check. It is built as "componentName:checkName", where "componentName" is the name of a single component or category and "checkName" is the name of the check itself.

##### componentId
*(optional)* The unique ID of the component.

##### componentType
*(optional)* Should be present, if the name has a "componentName". One of "system" or "component".

##### observedValue
*(optional)* The value which was determined by the check as a valid JSON value.

##### observedUnit
*(optional)* The unit of measurement the observedValue is reported in.

##### status
*(required)* The status of this check with the values "pass", "fail", "warn" or "info".

##### time
*(optional)* is the date-time, in ISO8601 format, at which the reading of the observedValue was recorded or the check itself happened.

##### output
*(optional)* the raw error or warn message, possibly human-readable. Should be ommitted for status "pass". Can also contain additional information for the status "info".

## Security

For security reasons of the provided informations the implemented CMS healh check API should only reply to a HTTPS POST request and only if the request brings a security token. The security tolken should be at least 16 characters of three groups (uppercase, lowercase, digits). The implementation in the CMS should provide a function to revoke the security token. 

## CMS Integration

To handle CMS integration, different client plugins / extensions / modules could be used. These define the endpoints needed for the communication to the monitoring server and deliver the application-based check results based on the checks that are implemented in the client component or CMS.

### WordPress

For WordPress, a "Site Health Check" already exists as a core component. The implementation of the client plugin aims to adopt that and gives the possibility to deliver all results of the WordPress Site Health Check also via the CMS Health Check API. New checks can directly be registered as WordPress Site Health Checks and can than automatically be used in the CMS Health Check API.

For more information about the WordPress Site Health Check see https://wordpress.org/documentation/article/site-health-screen/.

### TYPO3

