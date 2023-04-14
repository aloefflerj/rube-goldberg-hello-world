use std::env;

fn main() {
    let mut args: Vec<String> = env::args().collect();
    args.retain(|value| *value != "./hello");
    let arg: String = args.into_iter().collect();
    println!("{}", arg);
}