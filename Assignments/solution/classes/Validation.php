SELECT * FROM contacts;<?php
class Validation {
    private $errors = [];

    // Check format based on regex type and set custom error message if provided
    public function checkFormat($value, $type, $customErrorMsg = null) {
        $patterns = [
            'name' => '/^[a-z\'\s-]{1,50}$/i',
            'phone' => '/^\d{3}\.\d{3}\.\d{4}$/',
            'address' => '/^[a-zA-Z0-9\s,.\'-]{1,100}$/',
            'zip' => '/^\d{5}(-\d{4})?$/',
            'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'none' => '/.*/'
        ];



        // Use a generic default pattern if the type is not defined
        $pattern = $patterns[$type] ?? '/.*/';

        if (!preg_match($pattern, $value)) {
            $errorMessage = $customErrorMsg ?? "Invalid $type format.";
            $this->errors[$type] = $errorMessage;
            return false;
        }
        return true;
    }

    // Get all validation errors
    public function getErrors() {
        return $this->errors;
    }

    // Check if there are any errors
    public function hasErrors() {
        return !empty($this->errors);
    }
    // Simple email validation
    public function isEmail($email) {
        return preg_match("/^[^@\s]+@[^@\s]+\.[^@\s]+$/", $email);
    }

    // Simple password validation (non-blank, up to 255 chars)
    public function isPassword($password) {
        return preg_match("/^.{1,255}$/", $password);
    }

    public function validateContact($data) {
    $errors = [];

    // First name
    if (empty($data['fname']) || !preg_match("/^[A-Za-z' -]+$/", $data['fname'])) {
      $errors[] = "Invalid first name";
    }

    // Last name
    if (empty($data['lname']) || !preg_match("/^[A-Za-z' -]+$/", $data['lname'])) {
        $errors[] = "Invalid last name";
    }

    // Address (allow numbers, letters, spaces, punctuation)
    if (empty($data['address']) || !preg_match("/^[0-9A-Za-z\s,.'-]+$/", $data['address'])) {
        $errors[] = "Invalid address";
    }

    // City
    if (empty($data['city']) || !preg_match("/^[A-Za-z\s'-]+$/", $data['city'])) {
        $errors[] = "Invalid city";
    }

    // Phone (allow dashes or dots)
    if (empty($data['phone']) || !preg_match("/^\d{3}[-.]?\d{3}[-.]?\d{4}$/", $data['phone'])) {
        $errors[] = "Invalid phone format";
    }
    // Email
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email";
    }

    // DOB (YYYY-MM-DD for MySQL DATE)
    if (empty($data['dob']) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $data['dob'])) {
        $errors[] = "Invalid date of birth format (use YYYY-MM-DD)";
    }

    // Age range
    if (empty($data['age'])) {
        $errors[] = "You must select an age range";
    }

    return $errors;
}

}


?>
