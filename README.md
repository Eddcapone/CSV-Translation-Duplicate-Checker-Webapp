# CSV Translation Duplicate Checker (Web Application)

The **CSV Translation Duplicate Checker** is a web application designed to assist in managing and validating translation strings. By uploading a CSV file of existing translations and entering new translation strings, users can check for duplicates, matches, and unmatched entries efficiently.

**Note**: There is also a python / .exe Version for this application [here](https://github.com/Eddcapone/CSV-Translation-Duplicate-Checker).

## How to Use

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/Eddcapone/csv_translation_duplicate_checker.git
   cd csv-translation-checker
   
2. **Set Up a Local Server: Use a tool like XAMPP, WAMP, or any PHP-compatible server. Place the project files in your server’s public directory.**

3. **Open the Application: Navigate to the project in your browser (e.g., http://localhost/csv-translation-checker/index.html).**

4. **Use the Application:**

- Upload a CSV file with existing translations.
- Enter a list of new translation strings (one string per line).
- Click Check Words to analyze the input and view results.

5. **View Results:**

- Found Words: A list of strings from the input that match entries in the CSV.
- Not Found Words (if enabled): Strings from the input that do not match any entry in the CSV.
- Duplicates (if enabled): Entries in the CSV that are duplicated.

## Example Input and Output

### Example CSV (translations.csv):

```
"Your Address", "Votre adresse"
Personal Details, Informations personnelles
"Password Strength","Force du mot de passe"
"No Password","aucun mot de passe"
"No Password","Foo"
"Bar","aucun mot de passe"
```

### Example Input (Text Area):

```
Password Strength
Votre adresse
Prix
```

### Example Output (Displayed in the Browser):

#### Example A:

![image](https://github.com/user-attachments/assets/d098b39e-69f8-4008-8a2e-ec701b381dd6)

#### Example B:

![image](https://github.com/user-attachments/assets/ddb8267f-a0bb-44e5-b52f-041ce9b06476)



## Features

- **CSV Upload**: Easily upload a CSV file containing existing translations.
- **Dynamic Input**: Enter new translation strings directly into the browser.
- **Case Sensitivity**:
  - A "Case Sensitive" checkbox lets you control whether matches and duplicates should respect the case of characters.
- **Real-Time Matching**:
  - **Found Words**: Strings from the input list that already exist in the CSV.
  - **Not Found Words**: Strings from the input list that are not in the CSV.
  - **Duplicates**: Strings in the CSV that are duplicated.
- **Customizable Results**:
  - Enable or disable the display of unmatched words and duplicates with simple checkboxes.
- **User-Friendly Interface**:
  - Results displayed as lists for better readability.
  - Progress bar to indicate the processing status.

## Notes
- Strings are compared without case sensitivity or surrounding quotes (e.g., "Password Strength" and password strength are treated as equal).
- The checkboxes for unmatched words and duplicates are disabled by default and must be enabled manually to display these results.
- Results are displayed as lists, with each item in its own row for easy readability.


## License

This project is licensed under the MIT License.



