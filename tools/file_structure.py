import os

def list_files(startpath, output_file):
    with open(output_file, 'w', encoding='utf-8') as f:
        for root, dirs, files in os.walk(startpath):
            # Исключаем папку .git
            if '.git' in dirs:
                dirs.remove('.git')

            level = root.replace(startpath, '').count(os.sep)
            indent = ' ' * 4 * (level)
            f.write(f'{indent}{os.path.basename(root)}/\n')

            sub_indent = ' ' * 4 * (level + 1)
            for file in files:
                f.write(f'{sub_indent}{file}\n')

if __name__ == "__main__":
    current_directory = os.getcwd()
    output_file = "file_structure.txt"
    print(f"Saving file structure of {current_directory} to {output_file}...\n")
    list_files(current_directory, output_file)
    print("File structure saved successfully!")
