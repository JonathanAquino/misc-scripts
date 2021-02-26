# If you come from bash you might have to change your $PATH.
# export PATH=$HOME/bin:/usr/local/bin:$PATH
export PATH=/usr/local/bin:/usr/local/sbin:$PATH

# Path to your oh-my-zsh installation.
export ZSH=~/.oh-my-zsh

# Set name of the theme to load. Optionally, if you set this to "random"
# it'll load a random theme each time that oh-my-zsh is loaded.
# See https://github.com/robbyrussell/oh-my-zsh/wiki/Themes
ZSH_THEME="robbyrussell"

# Uncomment the following line to use hyphen-insensitive completion. Case
# sensitive completion must be off. _ and - will be interchangeable.
HYPHEN_INSENSITIVE="true"

# Uncomment the following line if you want to change the command execution time
# stamp shown in the history command output.
# The optional three formats: "mm/dd/yyyy"|"dd.mm.yyyy"|"yyyy-mm-dd"
HIST_STAMPS="yyyy-mm-dd"

HISTSIZE=1000000
SAVEHIST=1000000
setopt hist_ignore_all_dups

# Which plugins would you like to load? (plugins can be found in ~/.oh-my-zsh/plugins/*)
# Custom plugins may be added to ~/.oh-my-zsh/custom/plugins/
# Example format: plugins=(rails git textmate ruby lighthouse)
# Add wisely, as too many plugins slow down shell startup.
plugins=(autojump history-substring-search gitfast fzf-tab)

# Needed for using autojump for zsh
[ -f /usr/local/etc/profile.d/autojump.sh ] && . /usr/local/etc/profile.d/autojump.sh

source $ZSH/oh-my-zsh.sh

# 10 second wait if you do something that will delete everything.
setopt RM_STAR_WAIT

# User configuration

alias gack="git ls-files | ack -x"
alias gacki="git ls-files | ack -x -i"
# https://stackoverflow.com/a/6511327
alias shuffle="perl -MList::Util=shuffle -e 'print shuffle(<STDIN>);'"
# "Find micro"
alias fm="micro \`fzf\`"

# For lf
export EDITOR='micro'
source ~/.config/lf/lfcd.sh

source ~/.zshrc-extras

# Like ack but lets you open an editor on a search result.
# brew install fzf ripgrep bat micro
ak() {
  echo rg --column --line-number --no-heading --color=always --sort=path "$@"
  rg --column --line-number --no-heading --color=always --sort=path "$@" | fzf --reverse --ansi --delimiter ':' --bind "enter:execute:(micro -parsecursor on {1}:{2})"
}
